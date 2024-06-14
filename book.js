document.addEventListener('DOMContentLoaded', function() {
    function isLoggedIn() {
        // Ελέγχει αν ο χρήστης είναι συνδεδεμένος , αν όχι τον πετάει στο login
        return true;
    }

    function Amount(nights) {
        let starting_amount = propertyDetails.price * nights;
        let discount = (Math.random() * (30 - 10)) + 10;
        let discount_amount = starting_amount * (discount / 100);
        return starting_amount - discount_amount;
    }

    if (!isLoggedIn()) {
        alert('Δεν είστε συνδεδεμένος');
        window.location.href = 'login.html';
    } else {
        loadPropertyDetails();
        document.getElementById('booking_date').style.display = 'block';
    }

    document.getElementById('availability').addEventListener('click', function() {
        let startDate = new Date(document.getElementById('start_date').value);
        let endDate = new Date(document.getElementById('finish_date').value);

        if (startDate >= endDate) {
            alert('Η ημερομηνία άφιξης πρέπει να είναι πριν την ημερομηνία αναχώρησης');
            return;
        }
        // διαθεσιμότητα ακινήτου

        let nights = (endDate - startDate) / (1000 * 60 * 60 * 24);
        let amount = Amount(nights);

        document.getElementById('date').style.display = 'none';
        document.getElementById('user_data').style.display = 'block';

        document.getElementById('amount').innerText = `Τελικό Ποσό Πληρωμής: €${amount}`;
    });

    document.getElementById('booking_date').addEventListener('submit', function(event) {
        event.preventDefault();
        alert('Η κράτηση πραγματοποιήθηκε επιτυχώς!');
        window.location.href = 'feed.html';
    });
});
