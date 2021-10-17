
document.addEventListener("DOMContentLoaded", function () {
    if(window.Litepicker){
        document.querySelectorAll(".datepicker").forEach((e) => {
            (new Litepicker({
                element: e,
                buttonText: {
                    previousMonth: '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>',
                    nextMonth: '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>',
                },
            }));
        })
    }

    document.querySelector(".is-paid").onchange = ((e) => {
        if (e.target.checked) {
            document.querySelector(".is-paid-label").innerText = 'Yes';
            document.querySelector("#isPaid").value = 'Y';
        } else {
            document.querySelector(".is-paid-label").innerText = 'No';
            document.querySelector("#isPaid").value = 'N';
        }
    })

    document.querySelector(".submit-form").onclick = ((e) => {
        e.preventDefault();
        document.forms["invoiceItemForm"].requestSubmit();
    });

    document.querySelectorAll('.invoice-item').forEach(element => {
        element.onclick = ((e) => {
            document.querySelector('#itemProductId').value = e.target.dataset.productId;
            document.querySelector('#itemQuantity').value = e.target.dataset.quantity;
            document.querySelector('#itemNotes').value = e.target.dataset.notes;
            document.querySelector('#itemId').value = e.target.dataset.itemId;
        });
    });
});