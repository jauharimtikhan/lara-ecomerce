import { autocomplete } from "@algolia/autocomplete-js";
import { algoliasearch } from "algoliasearch";
import instantsearch from "instantsearch.js";
import historyRouter from "instantsearch.js/es/lib/routers/history";
import { connectSearchBox } from "instantsearch.js/es/connectors";
import {
    hierarchicalMenu,
    hits,
    pagination,
} from "instantsearch.js/es/widgets";

import "@algolia/autocomplete-theme-classic";

const props = window.PageProps;

document.addEventListener("livewire:navigated", () => {
    const searchClient = algoliasearch(
        props.algoliaEnv.appId,
        props.algoliaEnv.apiKey
    );

    const btnGlobalSearch = document.getElementById("btnGlobalSearch");
    const globalSearchContainer = document.getElementById("global-search");
    const globalSearchResult = document.getElementById("global-search-result");
    const inputGlobalSearch = document.getElementById("inputGlobalSearch");

    const INSTANT_SEARCH_INDEX_NAME = "products";

    btnGlobalSearch.addEventListener("click", () => {
        globalSearchContainer.classList.toggle("hidden");
        const instantSearchRouter = historyRouter({
            cleanUrlOnDispose: false,
        });
        const search = instantsearch({
            searchClient,
            indexName: INSTANT_SEARCH_INDEX_NAME,
            routing: instantSearchRouter,
            future: {
                preserveSharedStateOnUnmount: true,
            },
        });
        const virtualSearchBox = connectSearchBox(() => {});

        search.addWidgets([
            virtualSearchBox({}),
            hierarchicalMenu({
                container: "#categories-algolia",
                attributes: [
                    "hierarchicalCategories.lvl0",
                    "hierarchicalCategories.lvl1",
                ],
            }),
            hits({
                container: "#hits-algolia",
                templates: {
                    item(hit, { html, components }) {
                        return html`
                            <a
                                href="${props.appUrl}/membership/productdetail?id=${hit.id}"
                                class="w-full"
                            >
                                ${components.Highlight({
                                    attribute: "name",
                                    cssClasses: "uppercase",
                                    hit,
                                })}
                            </a>
                        `;
                    },
                },
            }),
        ]);

        search.start();

        function setInstantSearchUiState(indexUiState) {
            search.setUiState((uiState) => ({
                ...uiState,
                [INSTANT_SEARCH_INDEX_NAME]: {
                    ...uiState[INSTANT_SEARCH_INDEX_NAME],
                    // We reset the page when the search state changes.
                    page: 1,
                    ...indexUiState,
                },
            }));
        }

        // Return the InstantSearch index UI state.
        function getInstantSearchUiState() {
            const uiState = instantSearchRouter.read();

            return (uiState && uiState[INSTANT_SEARCH_INDEX_NAME]) || {};
        }

        const searchPageState = getInstantSearchUiState();

        let skipInstantSearchUiStateUpdate = false;
        const { setQuery } = autocomplete({
            container: "#autocomplete-algolia",
            placeholder: "Cari Produk....",
            detachedMediaQuery: "none",
            initialState: {
                query: searchPageState.query || "",
            },
            onSubmit({ state }) {
                setInstantSearchUiState({ query: state.query });
            },
            onReset() {
                setInstantSearchUiState({ query: "" });
            },
            onStateChange({ prevState, state }) {
                if (
                    !skipInstantSearchUiStateUpdate &&
                    prevState.query !== state.query
                ) {
                    setInstantSearchUiState({ query: state.query });
                }
                skipInstantSearchUiStateUpdate = false;
            },
        });

        // This keeps Autocomplete aware of state changes coming from routing
        // and updates its query accordingly
        window.addEventListener("popstate", () => {
            skipInstantSearchUiStateUpdate = true;
            setQuery(search.helper?.state.query || "");
        });
    });
});
