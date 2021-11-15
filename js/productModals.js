var productModal = document.getElementById('productModal');
productModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;

    /* 
    data-bs-formAction="edit"
    data-bs-productName="Product<?php echo($i); ?>"
    data-bs-productPrice="330.30"
    data-bs-productStock="12"
    data-bs-productImage="Afbeelding"
    data-bs-productID="<?php echo($i); ?>"
    */

    var modalTitle = productModal.querySelector('.modal-title');

    if (button.getAttribute('data-bs-formAction') == 'edit'){
        modalTitle.textContent = 'Wijzig product: ' + button.getAttribute('data-bs-productName');
        productModal.querySelector('#productAanpassenSubmit').value = "Wijzigen";
    } else {
        modalTitle.textContent = 'Een nieuw product toevoegen';
        productModal.querySelector('#productAanpassenSubmit').value = "Toevoegen";
    }

    productModal.querySelector('#formAction').value = button.getAttribute('data-bs-formAction');
    productModal.querySelector('#productID').value = button.getAttribute('data-bs-productID');
    productModal.querySelector('#productName').value = button.getAttribute('data-bs-productName');
    productModal.querySelector('#productDescription').value = button.getAttribute('data-bs-productDescription');
    productModal.querySelector('#productPrice').value = button.getAttribute('data-bs-productPrice');
    productModal.querySelector('#productStock').value = button.getAttribute('data-bs-productStock');
    productModal.querySelector('#productImage').value = button.getAttribute('data-bs-productImage');
})
