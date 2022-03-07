import React, { useState } from "react";
import ReactDOM from "react-dom";
import { useLocation, useNavigate } from "react-router-dom";

const LoginPage = () => {
    const [email, setEmail] = useState("user@example.com");
    const [password, setPassword] = useState("password");
    const navigate = useNavigate();
    const location = useLocation();

    function handleLogin(event) {
        event.preventDefault();

        axios
            .post("api/login", { email: email, password: password })
            .then((response) => {
                localStorage.setItem("userToken", response.data.token);
                if (location.state?.from) {
                    navigate(location.state.from);
                } else {
                    navigate("/");
                }
            })
            .catch((err) => {
                console.error(err.response.data);
            });
    }
    return (
        <div className="container ">
            <h1 className="flex align-middle justify-center font-medium">
                Login
            </h1>
            <div className="bg-blue-300">
                <form onSubmit={handleLogin}>
                    <div className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                        <div className="mb-4">
                            <label className="block text-grey-darker text-sm font-bold mb-2">
                                Username
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                type="text"
                                name="email"
                                required
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                            />
                        </div>
                        <div className="mb-6">
                            <label className="block text-grey-darker text-sm font-bold mb-2">
                                Password
                            </label>
                            <input
                                className="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                                type="password"
                                name="password"
                                required
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                placeholder="******************"
                            />
                        </div>
                        <div className="flex items-center justify-between">
                            <button
                                className="bg-blue hover:bg-blue-dark text-black font-bold rounded p-4 border-2 m-4"
                                type="submit"
                            >
                                Sign In
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default LoginPage;
