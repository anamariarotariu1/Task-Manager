import "./LoginCard.scss";
import {useForm} from "react-hook-form";
import axios from "axios";

function LoginCard() {
    const {register, handleSubmit} = useForm();
    const loginUser = (values) => {
        console.log("Password = ", values.password);
    }
    return <div>
        <form onSubmit={handleSubmit(loginUser)} className="form-container">
            <div className="form-item">
                <label htmlFor="email">Email</label>
                <input {...register("email", {required: true})} type="email" id="email"/>
            </div>
            <div className="form-item">
                <label htmlFor="password">Password</label>
                <input {...register("password", {required: true})} type="password" id="password"/>
            </div>
            <input type="submit"/>
        </form>
    </div>
}

export default LoginCard;
