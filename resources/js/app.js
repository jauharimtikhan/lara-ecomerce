import "./bootstrap";
import "flowbite";
import {
    Datepicker,
    initDatepickers,
    initCarousels,
    initFlowbite,
    initDropdowns,
    initPopovers,
    Dismiss,
    initDismisses,
    initInputCounters,
    initModals,
} from "flowbite";
document.addEventListener("livewire:navigated", () => {

    AOS.init();
    const dismiss = document.querySelector('#toast-default');
    Livewire.on('alert', () => {
        setTimeout(() => {
            dismiss.classList.add('hidden');
        }, 3000);
    })
  const pageProps = window.PageProps;
    const dismiss = document.getElementById(`alert-${pageProps.session}`);
    Livewire.on("alert", () => {
        dismiss.classList.add("block");
        setTimeout(() => {
            dismiss.classList.add("hidden");
        }, 3000);
    });
    var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
    var themeToggleLightIcon = document.getElementById(
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

    var themeToggleBtn = document.getElementById("theme-toggle");

    themeToggleBtn.addEventListener("click", function () {
        // toggle icons inside button
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
    });

    const backToTopButton = document.getElementById("backToTop");
    backToTopButton.addEventListener("click", scrollToTop);

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    }

    // Menampilkan tombol setelah scroll
    window.onscroll = function () {
        const backToTopButton = document.getElementById("backToTop");
        if (
            document.body.scrollTop > 200 ||
            document.documentElement.scrollTop > 200
        ) {
            backToTopButton.classList.remove("hidden");
        } else {
            backToTopButton.classList.add("hidden");
        }
    };
    const navbarContainer = document.getElementById("navbarContainer");
    navbarContainer.classList.add("fixed");
    window.addEventListener("scroll", () => {
        if (window.scrollY >= 0) {
            navbarContainer.classList.add("fixed");
            navbarContainer.style.transition =
                "all 0.3s ease-in-out"; // Properti transition diatur setelah class ditambahkan
        } else {
            navbarContainer.classList.remove("fixed");
            navbarContainer.style.transition =
                "all 0.3s ease-in-out"; // Masih memberikan transisi meskipun class dihapus
        }
    });

    // initDatepickers();
    // initCarousels();
    // initDropdowns();
    // initFlowbite();
    // initPopovers();
    // initInputCounters();
    // initModals();

});
