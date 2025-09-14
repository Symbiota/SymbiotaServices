function calc_each_service_bill(id) {
    let qty_box = document.getElementById('qty_' + id);
    let amount_owed_box = document.getElementById('amount_owed_' + id);
    let price_per_unit = qty_box.getAttribute('service_price');
    let qty = qty_box.value;
    let amount_owed = price_per_unit * qty;
    amount_owed_box.value = amount_owed.toFixed(2);
}

function calc_total_amount_billed() {
    let total_box = document.getElementById('amount_billed');
    let total = 0;
    const checkboxes = document.querySelectorAll('#service:checked');

    checkboxes.forEach(checkbox => {
        let amount_owed_box = document.getElementById('amount_owed_' + checkbox.value);
            total += parseFloat(amount_owed_box.value);
        });

    total_box.value = total.toFixed(2);
}
