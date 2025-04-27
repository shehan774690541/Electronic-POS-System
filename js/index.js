let loggedIn = false; // default: not logged in

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return "";
    }

    function togglePanel() {
        const panel = document.getElementById('userPanel');
        if (panel.style.display === 'block') {
            panel.style.display = 'none';
        } else {
            panel.style.display = 'block';
        }
    }

    function updatePanel() {
        const panel = document.getElementById('userPanel');
        panel.innerHTML = '';

        if (loggedIn) {
            // After login panel
            const userName = document.createElement('div');
            userName.innerText = "Chappie Ghost";

            const userEmail = document.createElement('div');
            userEmail.innerText = "chappieghost2028@example.com";

            const logoutBtn = document.createElement('button');
            logoutBtn.innerText = "Logout";
            logoutBtn.onclick = () => {
                loggedIn = false;
                togglePanel();
            };

            panel.appendChild(userName);
            panel.appendChild(userEmail);
            panel.appendChild(logoutBtn);

        } else {
            // Before login panel
            const loginBtn = document.createElement('button');
            loginBtn.innerText = "Login";
            loginBtn.onclick = () => {
                loggedIn = true;
                togglePanel();
            };

            const registerBtn = document.createElement('button');
            registerBtn.innerText = "Register";
            registerBtn.onclick = () => {
                alert('Redirect to register page...');
            };

            panel.appendChild(loginBtn);
            panel.appendChild(registerBtn);
        }
    }
    function user_login(logType){
        if (logType != "logout"){
            window.location.href = "admin/" + logType;
        }else{
            localStorage.setItem('token','');
            document.cookie = "_uid=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";    
            document.cookie = "_role=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "_expiry=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "_uname=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";    
            window.location.href = "";
        }
    }

    const userData =  localStorage.getItem("token");
    if(userData != "" && getCookie("_uid") == ""){
        window.location.reload(true);   
    }else{
        console.log("user data : ", userData);
        var cki = getCookie("_uid");
        console.log("cookie", cki);
    }

    if (userData) {
        try {
            const decodedData = atob(userData);
            const jsonData = JSON.parse(decodedData);
            document.cookie = "_uid=" + jsonData.id + "; expires=" + new Date(new Date().getTime() + 24 * 60 * 60 * 1000).toUTCString() + "; path=/";    
            document.cookie = "_role=" + jsonData.role_id + "; expires=" + new Date(new Date().getTime() + 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
            document.cookie = "_expiry=" + jsonData.token_expiry + "; expires=" + new Date(new Date().getTime() + 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
            document.cookie = "_uname=" + jsonData.user_name + "; expires=" + new Date(new Date().getTime() + 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
        } catch (error) {
            console.error("Error decoding or parsing user data:", error);
        }
    }

    