import "./Login.scss";
import Logo from "../../components/Logo/Logo";
import LoginCard from "../../components/LoginCard/LoginCard";

function Login() {
    return <div className="login-page">
        <Logo/>
        <LoginCard/>
    </div>
}

export default Login;