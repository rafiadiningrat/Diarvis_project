import { useContext } from "react";
import { Navigate, Outlet } from "react-router-dom";
import { UserContext } from "../App";

const PrivateRoutes = () => {
    const isLoggedIn  = useContext(UserContext);
    return(
        isLoggedIn.user ? <Outlet/> : <Navigate to="/login"/>
    )
}

export default PrivateRoutes