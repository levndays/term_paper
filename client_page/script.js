// script.js
function toggleTransactionForm(accountId) {
    const form = document.getElementById('transactionForm' + accountId);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function submitTransactionForm(accountId) {
    const form = document.getElementById('transactionForm' + accountId);
    const formData = new FormData(form);


    fetch('submit_transaction.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {

        alert(data.message);

        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function goToIndex() {
    window.location.href = '../index.html';
}
