document.getElementById('create-listing-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let title = document.getElementById('title').value;
    let region = document.getElementById('region').value;
    let room = document.getElementById('room').value;
    let price = document.getElementById('price').value;
    let photo = document.getElementById('photo').files[0];
    let errorMessage = '';

    if (!/^[a-zA-Z\s]+$/.test(title)) {
        errorMessage += 'Ο τίτλος πρέπει να περιέχει μόνο χαρακτήρες.\n';
    }

    if (!/^[a-zA-Z\s]+$/.test(region)) {
        errorMessage += 'Η περιοχή πρέπει να περιέχει μόνο χαρακτήρες.\n';
    }

    if (!Number.isInteger(Number(room)) || Number(room) <= 0) {
        errorMessage += 'Το πλήθος δωματίων πρέπει να είναι ακέραιος αριθμός.\n';
    }

    if (!Number.isInteger(Number(price)) || Number(price) <= 0) {
        errorMessage += 'Η τιμή ανά διανυκτέρευση πρέπει να είναι ακέραιος αριθμός.\n';
    }

    if (errorMessage) {
        alert(errorMessage);
    } else {
        let formdata = new FormData();
        formdata.append('title', title);
        formdata.append('region', region);
        formdata.append('room', room);
        formdata.append('price', price);
        formdata.append('photo', photo);

        fetch('new_listing.php', {
            method: 'POST',
            body: formdata
        })
        .then(response => response.json())        
        .then(
            data => {
                if (data.status === 'success') {
                    alert('Η αγγελία δημιουργήθηκε επιτυχώς!');
                    window.location.href = '../Feed/feed.php';
                } else {
                    alert(data.message);
                }
            })
        .catch(error => {
            console.log(error.message);
        });

    }
});
