import "./RegisterCard.scss";
import {useForm} from "react-hook-form";
import axios from "axios";

function RegisterCard() {
    const {register, handleSubmit} = useForm();
    const submitInfo = (values) => {
        console.log(values);
        axios.post('http://localhost:8089/api/create-user', {
            email: `${values.email}`,
            firstName: `${values.firstName}`,
            lastName: `${values.lastName}`,
            password: `${values.password}`
        }).then(response => {
            if (response.status === 200) {
                window.location.href = "/login";
            }
        }).catch(error => {
            alert("An error occurred. Try again.")
            console.log(error);
        });
    }
    return <div>
        <form onSubmit={handleSubmit(submitInfo)} className="form-container">
            <div className="form-item">
                <label htmlFor="firstName" className="form-label">First name</label>
                <input {...register("firstName", {required: true})} id="firstName" className="form-input"/>
            </div>
            <div className="form-item">
                <label htmlFor="lastName" className="form-label">Last name</label>
                <input {...register("lastName", {required: true, pattern: /^[A-Za-z]+$/i})} id="lastName"
                       className="form-input"/>

            </div>
            <div className="form-item">
                <label htmlFor="email" className="form-label">Email</label>
                <input {...register("email", {required: true})} type="email" id="email" className="form-input"/>
            </div>
            <div className="form-item">
                <label htmlFor="password" className="form-label">Password</label>
                <input {...register("password", {required: true})} type="password" id="password"
                       className="form-input"/>
            </div>
            <input type="submit"/>
        </form>
    </div>
}

export default RegisterCard;