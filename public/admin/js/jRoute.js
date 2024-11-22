(function ($) {
    // Simpan semua route yang diterima dari Laravel
    const routes = window.routes || {};

    /**
     * Plugin jQuery untuk menghasilkan URL dari route Laravel
     * @param {string} name Nama route Laravel
     * @param {Object} params Parameter dinamis yang dibutuhkan oleh route
     * @returns {string} URL yang dihasilkan
     */
    $.route = function (name, params = {}) {
        if (!routes[name]) {
            throw new Error(`Route "${name}" tidak ditemukan.`);
        }

        let url = routes[name];

        // Gantikan parameter dinamis dalam URL
        Object.keys(params).forEach((key) => {
            const value = params[key];
            url = url.replace(`{${key}}`, value);
        });

        // Validasi jika masih ada parameter yang belum digantikan
        if (url.includes(["{", "}"])) {
            throw new Error(`Parameter untuk route "${name}" tidak lengkap.`);
        }

        // Kembalikan URL dengan normalisasi (hapus double slash)
        return `/${url}`.replace(/\/+/g, "/");
    };
    $.calculateBrightness = function (hex) {
        // Mengonversi hex ke RGB
        const r = parseInt(hex.substr(0, 2), 16);
        const g = parseInt(hex.substr(2, 2), 16);
        const b = parseInt(hex.substr(4, 2), 16);

        // Menghitung kecerahan berdasarkan rumus berbobot
        const brightness = 0.299 * r + 0.587 * g + 0.114 * b;

        // Mengembalikan kategori berdasarkan nilai kecerahan
        if (brightness > 128) {
            return "terang";
        } else {
            return "gelap";
        }
    };
    $.colorNameIndo = [
        { name: "merah", hex: "#FF0000" },
        { name: "biru", hex: "#0000FF" },
        { name: "hijau", hex: "#008000" },
        { name: "kuning", hex: "#FFFF00" },
        { name: "jingga", hex: "#FFA500" },
        { name: "ungu", hex: "#800080" },
        { name: "coklat", hex: "#A52A2A" },
        { name: "hitam", hex: "#000000" },
        { name: "putih", hex: "#FFFFFF" },
        { name: "abu-abu", hex: "#808080" },
        { name: "merah muda", hex: "#FFC0CB" },
        { name: "biru muda", hex: "#ADD8E6" },
        { name: "hijau muda", hex: "#90EE90" },
        { name: "kuning muda", hex: "#FFFFE0" },
        { name: "emas", hex: "#FFD700" },
        { name: "perak", hex: "#C0C0C0" },
        { name: "biru tua", hex: "#00008B" },
        { name: "hijau tua", hex: "#006400" },
        { name: "merah tua", hex: "#8B0000" },
        { name: "toska", hex: "#40E0D0" },
        { name: "nila", hex: "#4B0082" },
        { name: "lavender", hex: "#E6E6FA" },
        { name: "salem", hex: "#FA8072" },
        { name: "teal", hex: "#008080" },
        { name: "magenta", hex: "#FF00FF" },
        { name: "cyan", hex: "#00FFFF" },
        { name: "lime", hex: "#00FF00" },
        { name: "zaitun", hex: "#808000" },
        { name: "marun", hex: "#800000" },
        { name: "karamel", hex: "#D2691E" },
        { name: "tan", hex: "#D2B48C" },
        { name: "beige", hex: "#F5F5DC" },
    ];
})(jQuery);

(function (global) {
    /**
     * Generate a unique ID if not provided
     * @returns {string} A unique identifier
     */
    function generateUniqueId() {
        return "uid-" + Math.random().toString(36).substr(2, 9);
    }

    /**
     * Attach a unique selector to an element
     * @param {HTMLElement} element - The DOM element to make unique
     * @param {string} [customId] - Optional custom ID for the unique selector
     * @returns {string} The unique ID of the element
     */
    global.makeUniqueSelector = function (element, customId = null) {
        if (!element) {
            console.error("Element not found or invalid.");
            return null;
        }

        let uniqueId =
            customId ||
            element.getAttribute("data-unique-id") ||
            generateUniqueId();
        element.setAttribute("data-unique-id", uniqueId);
        return uniqueId;
    };

    /**
     * Get element by unique selector globally
     * @param {string} uniqueId - The unique ID to search for
     * @returns {HTMLElement | null} The DOM element or null if not found
     */
    global.getUniqueElement = function (uniqueId) {
        return document.querySelector(`[data-unique-id="${uniqueId}"]`);
    };

    /**
     * Example usage: Attach events using unique selectors
     */
    global.attachUniqueEvent = function (uniqueId, eventType, callback) {
        const element = global.getUniqueElement(uniqueId);
        if (element) {
            element.addEventListener(eventType, callback);
        } else {
            console.error(`No element found with data-unique-id: ${uniqueId}`);
        }
    };
})(window);
