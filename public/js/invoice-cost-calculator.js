function calc_each_service_bill() {
    for (let id = 1; id <= document.querySelectorAll('#service').length; id++) {
        const qty_box = document.getElementById('qty_' + id);
        const amount_owed_box = document.getElementById('amount_owed_' + id);
        const price_per_unit = qty_box.getAttribute('service_price');
        const qty = qty_box.value;
        const amount_owed = price_per_unit * qty;
        amount_owed_box.value = amount_owed.toFixed(2);
    }
}

function calc_total_amount_billed() {
    const total_box = document.getElementById('amount_billed');
    let total = 0;
    const checkboxes = document.querySelectorAll('#service:checked');

    checkboxes.forEach(checkbox => {
        const amount_owed_box = document.getElementById('amount_owed_' + checkbox.value);
            total += parseFloat(amount_owed_box.value);
        });

    total_box.value = total.toFixed(2);
}

calc_each_service_bill();   // Calculates amount_billed for each service when page is opened/refreshed
calc_total_amount_billed(); // Calculates total value when page is opened/refreshed