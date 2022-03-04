const { Outlet, Navigate, useLocation } = require("react-router-dom");

const useAuth = () => {
    const userTokenCheck = localStorage.getItem("userToken");
    return userTokenCheck ? true : false;
};

const ProtectedRoutes = () => {
    const location = useLocation();
    const auth = useAuth();

    return auth ? (
        <Outlet />
    ) : (
        <Navigate replace to="/login" state={{ from: location }} />
    );
};

export default ProtectedRoutes;
