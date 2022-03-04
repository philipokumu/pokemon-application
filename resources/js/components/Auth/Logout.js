import React from "react";
import { useNavigate } from "react-router-dom";

function Logout() {
    const navigate = useNavigate();
    function handleLogout(event) {
        event.preventDefault();
        localStorage.removeItem("userToken");
        navigate("/login");
    }
    return (
        <div>
            <button className="p-4 border-2 m-4" onClick={handleLogout}>
                Logout
            </button>
        </div>
    );
}

export default Logout;
