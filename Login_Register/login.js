document.getElementById('show_register').addEventListener('click', function(event) {// Change scene to Register Form
    event.preventDefault();
    document.getElementById('form_login').style.display = 'none';
    document.getElementById('form_register').style.display = 'block';
});

document.getElementById('show_login').addEventListener('click', function(event) {// Change scene to Login Form
    event.preventDefault();
    document.getElementById('form_register').style.display = 'none';
    document.getElementById('form_login').style.display = 'block';
});

document.getElementById('register').addEventListener('submit', function(event) {//Register new user
    event.preventDefault();
    let firstname = document.getElementById('name').value;
    let lastname = document.getElementById('surname').value;
    let username = document.getElementById('register_username').value;
    let password = document.getElementById('register_password').value;
    let email = document.getElementById('email').value;
    let error_message = '';

    if (!/^[\p{L}\s]+$/u.test(firstname)) {
        error_message += 'Το όνομα πρέπει να περιέχει μόνο χαρακτήρες.\n';
    }

    if (!/^[\p{L}\s]+$/u.test(lastname)) {
        error_message += 'Το επώνυμο πρέπει να περιέχει μόνο χαρακτήρες.\n';
    }

    if (!/\d/.test(password) || password.length < 4 || password.length > 10) {
        error_message += 'Ο κωδικός πρόσβασης πρέπει να είναι μεταξύ 4 και 10 χαρακτήρων και να περιέχει τουλάχιστον έναν αριθμό.\n';
    }

    if (error_message) {
        alert(error_message);
    } 
    else {
        let formdata = new FormData();
        formdata.append('user_name', firstname);
        formdata.append('surname', lastname);
        formdata.append('username', username);
        formdata.append('password', password);
        formdata.append('email', email);
        
        fetch('new_user.php', {
            method: 'POST',
            body: formdata
        })
        .then(response => response.json())        
        .then(
            data => {
                if (data.status === 'success') {
                    alert('Εγγραφήκατε επιτυχώς! Παρακαλώ συνδεθείτε.');
                    document.getElementById('form_register').style.display = 'none';
                    document.getElementById('form_login').style.display = 'block';
                } else {
                    alert(data.message);
                }
            })
        .catch(error => {
            console.log('Error');
        });
    }
});

document.getElementById('login').addEventListener('submit', function(event) {//User Login
    event.preventDefault();
    let username = document.getElementById('login_username').value;
    let password = document.getElementById('login_password').value;
    
    let formdata = new FormData();
        formdata.append('username', username);
        formdata.append('password', password);
    
    fetch('check_user.php', {
        method: 'POST',
        body: formdata
    })
    .then(response => response.json())        
    .then(
        data => {
            if (data.status === 'success') {
                alert('Συνδεθήκατε επιτυχώς!');
                window.location.href  = "../Feed/feed.php";
            } else {
                alert(data.message);
            }
        })
    .catch(error => {
        console.error('Error:', error);
    });
});
