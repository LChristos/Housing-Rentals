document.addEventListener('DOMContentLoaded', function() {
    function Amount(nights , price) {
        let starting_amount = price * nights;
        let discount = (Math.random() * (30 - 10)) + 10;
        let discount_amount = starting_amount * (discount / 100);
        return starting_amount - discount_amount;
    }

    document.getElementById('availability').addEventListener('click', function() {
        let startDate = new Date(document.getElementById('start_date').value);
        let endDate = new Date(document.getElementById('finish_date').value);
        let price = document.getElementById('price').textContent;
        price = price.replace(/[^0-9.]/g, '');
        let listing_id = document.getElementById('listing_id').value;


        if (!document.getElementById('start_date').value || !document.getElementById('finish_date').value) {
            alert('Παρακαλώ εισάγετε τις ημερομηνίες.');
            return;
        }
        if (startDate >= endDate) {
            alert('Η ημερομηνία άφιξης πρέπει να είναι πριν την ημερομηνία αναχώρησης');
            return;
        }

        let formdata = new FormData();
        formdata.append('start_date', document.getElementById('start_date').value);
        formdata.append('finish_date', document.getElementById('finish_date').value);
        formdata.append('listing_id', listing_id);

        fetch('availability.php', {
            method: 'POST',
            body: formdata
        })
        .then(response => response.json())        
        .then(
            data => {
                if (data.status === 'failure') {
                    alert(data.message);
                }
                else {
                    let nights = (endDate - startDate) / (1000 * 60 * 60 * 24);
                    let amount = Amount(nights , price);
                    amount = amount.toFixed(2);
                    document.getElementById('date').style.display = 'none';
                    document.getElementById('user_data').style.display = 'block';
                    document.getElementById('amount').innerText = `Τελικό Ποσό Πληρωμής: €${amount}`;
                }
            })
        .catch(error => {
            console.log('Error');
        });
    });

    document.getElementById('booking_date').addEventListener('submit', function(event) {
        event.preventDefault();
        let firstname = document.getElementById('name').value;
        let lastname = document.getElementById('surname').value;
        let listing_id = document.getElementById('listing_id').value;
        let startDate = new Date(document.getElementById('start_date').value);
        let endDate = new Date(document.getElementById('finish_date').value);
        let email = document.getElementById('email').value;
        let amount = document.getElementById('amount').innerText.trim();
        amount = amount.replace(/[^0-9.]/g, '');
        
        let formdata = new FormData();
        formdata.append('listing_id', listing_id);
        formdata.append('user_name', firstname);
        formdata.append('surname', lastname);
        formdata.append('email', email);
        formdata.append('start_date', document.getElementById('start_date').value);
        formdata.append('finish_date', document.getElementById('finish_date').value);
        formdata.append('amount' , amount)

        fetch('add_reservation.php', {
            method: 'POST',
            body: formdata
        })
        .then(response => response.json())        
        .then(
            data => {
                if (data.status === 'success') {
                    alert('Η κράτηση πραγματοποιήθηκε επιτυχώς!');
                    window.location.href = '../Feed/feed.php';
                } else {
                    alert(data.message);
                }
            })
        .catch(error => {
            console.log('Error');
        });
    });
});
