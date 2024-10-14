import "./bootstrap";
import "flowbite";
import {
    initAccordions,
    initDismisses,
    initDropdowns,
    initFlowbite,
    initModals,
    Modal,
    Tabs,
} from "flowbite";

document.addEventListener("DOMContentLoaded", function () {
    // const tabsElement = document.getElementById("default-tab-content");
    initFlowbite();
    initDismisses();
    initModals();
    initAccordions();
    initDropdowns();
});

document.addEventListener("livewire:load", () => {
    initFlowbite();
    initDismisses();
    initModals();
    initAccordions();
    initDropdowns();
});

document.addEventListener("livewire:updated", () => {
    initFlowbite();
    initDismisses();
    initModals();
    initAccordions();
    initDropdowns();
});

document.addEventListener("livewire:navigated", () => {
    initFlowbite();
    initDismisses();
    initModals();
    initAccordions();
    initDropdowns();

    const sidebar = document.getElementById("sidebar");

    if (sidebar) {
        const toggleSidebarMobile = (
            sidebar,
            sidebarBackdrop,
            toggleSidebarMobileHamburger,
            toggleSidebarMobileClose
        ) => {
            sidebar.classList.toggle("hidden");
            sidebarBackdrop.classList.toggle("hidden");
            toggleSidebarMobileHamburger.classList.toggle("hidden");
            toggleSidebarMobileClose.classList.toggle("hidden");
        };

        const toggleSidebarMobileEl = document.getElementById(
            "toggleSidebarMobile"
        );
        const sidebarBackdrop = document.getElementById("sidebarBackdrop");
        const toggleSidebarMobileHamburger = document.getElementById(
            "toggleSidebarMobileHamburger"
        );
        const toggleSidebarMobileClose = document.getElementById(
            "toggleSidebarMobileClose"
        );
        const toggleSidebarMobileSearch = document.getElementById(
            "toggleSidebarMobileSearch"
        );

        toggleSidebarMobileSearch.addEventListener("click", () => {
            toggleSidebarMobile(
                sidebar,
                sidebarBackdrop,
                toggleSidebarMobileHamburger,
                toggleSidebarMobileClose
            );
        });

        toggleSidebarMobileEl.addEventListener("click", () => {
            toggleSidebarMobile(
                sidebar,
                sidebarBackdrop,
                toggleSidebarMobileHamburger,
                toggleSidebarMobileClose
            );
        });

        sidebarBackdrop.addEventListener("click", () => {
            toggleSidebarMobile(
                sidebar,
                sidebarBackdrop,
                toggleSidebarMobileHamburger,
                toggleSidebarMobileClose
            );
        });
    }

    const themeToggleDarkIcon = document.getElementById(
        "theme-toggle-dark-icon"
    );
    const themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );

    // Change the icons inside the button based on previous settings
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        themeToggleLightIcon.classList.remove("hidden");
    } else {
        themeToggleDarkIcon.classList.remove("hidden");
    }

    const themeToggleBtn = document.getElementById("theme-toggle");

    let event = new Event("dark-mode");

    themeToggleBtn.addEventListener("click", function () {
        // toggle icons
        themeToggleDarkIcon.classList.toggle("hidden");
        themeToggleLightIcon.classList.toggle("hidden");

        // if set via local storage previously
        if (localStorage.getItem("color-theme")) {
            if (localStorage.getItem("color-theme") === "light") {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            } else {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            }

            // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains("dark")) {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            } else {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            }
        }

        document.dispatchEvent(event);
    });
});
// Livewire.on("call-modal-update", () => {
//     const $targetEl = document.getElementById("update-permission");

//     // options with default values
//     const options = {
//         placement: "top-center",
//         backdrop: "static",
//         closable: true,
//         onHide: () => {
//             console.log("modal is hidden");
//         },
//         onShow: () => {
//             console.log("modal is shown");
//         },
//         onToggle: () => {
//             console.log("modal has been toggled");
//         },
//     };

//     // instance options object
//     const instanceOptions = {
//         id: "update-permission",
//         override: true,
//     };

//     const modal = new Modal($targetEl, options, instanceOptions);

//     modal.show();
// });
