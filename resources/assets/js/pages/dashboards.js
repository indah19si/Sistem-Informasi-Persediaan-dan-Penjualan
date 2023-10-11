const supplierSelect = document.getElementById('supplier');
const queryParams = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

if (queryParams.supplier) {
    supplierSelect.value = parseInt(queryParams.supplier);
}

supplierSelect.addEventListener('change', () => {
    window.location = `/dashboard?supplier=${encodeURIComponent(supplierSelect.value)}`;
});