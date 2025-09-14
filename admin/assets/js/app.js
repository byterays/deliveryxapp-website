class App {
    constructor() {
        this.initEvents();
        this.populateUserInfo();
    }

    // 🔑 Login function
    login(username, password, callback) {
        if (!username || !password) {
            if (callback) callback({ success: false, message: 'Please enter username and password.' });
            return;
        }

        $.ajax({
            url: '/api/login.php', // login API
            type: 'POST',
            data: { username: username, password: password },
            dataType: 'json',
            success: function (response) {
                if (callback) callback(response);
            },
            error: function (xhr, status, error) {
                if (callback) callback({ success: false, message: error });
            }
        });
    }

    // 🔑 Logout function
    logout(callback) {
        $.ajax({
            url: '/api/logout.php',
            method: 'POST',
            dataType: 'json',
            success: function (res) {
                if (callback) callback(res);
            },
            error: function () {
                if (callback) callback({ success: false, message: 'Server error during logout.' });
            }
        });
    }

    // 🔑 Get logged-in user info
    getUser(callback) {
        $.ajax({
            url: '/api/me.php', // you should create this API to return $_SESSION['LOGGED_IN_USER']
            method: 'GET',
            dataType: 'json',
            success: function (res) {
                if (callback) callback(res);
            },
            error: function () {
                if (callback) callback({ success: false, message: 'Unable to fetch user info.' });
            }
        });
    }

     // Populate username & role in the page
    populateUserInfo() {
        this.getUser((res) => {
            if (res.success && res.user) {
                $('#username').text(res.user.username || '');
                $('#email').text(res.user.email || '');
            } else {
                $('#username').text('');
                $('#email').text('');
                window.location.href = "/admin";
                // Optionally, redirect to login if not logged in
                // window.location.href = '/admin';
            }
        });
    }

    // 🔑 Attach UI event handlers
    initEvents() {
        // Login button
        $(document).on("click", "#btnLogin", (e) => {
            e.preventDefault();
            let username = $('#username').val();
            let password = $('#password').val();

            this.login(username, password, (response) => {
                if (response.success) {
                    $('#loginMessage').text('Login successful! Welcome ' + (response.username || ''));
                    window.location.href = '/admin/dashboard';
                } else {
                    $('#loginMessage').text('Login failed: ' + (response.message || 'Unknown error'));
                }
            });
        });

        // Logout link
        $(document).on("click", "#logout", (e) => {
            e.preventDefault();
            this.logout((res) => {
                if (res.success) {
                    window.location.href = "/admin";
                } else {
                    alert(res.message || "Logout failed, please try again.");
                }
            });
        });
    }
}

// ✅ initialize app when document is ready
$(document).ready(function () {
    window.App = new App();
});
