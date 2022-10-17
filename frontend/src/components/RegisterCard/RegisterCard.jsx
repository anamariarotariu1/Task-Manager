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
                console.log('register done successfully');
            }
        }).catch(error => {
            console.log('Oops, error');
            console.log(error);
        });
    }
    return <div>
        <form onSubmit={handleSubmit(submitInfo)} className="form-container">
            <div className="form-item">
                <label htmlFor="firstName">First name</label>
                <input {...register("firstName", {required: true})} id="firstName"/>
            </div>
            <div className="form-item">
                <label htmlFor="lastName">Last name</label>
                <input {...register("lastName", {required: true, pattern: /^[A-Za-z]+$/i})} id="lastName"/>

            </div>
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

export default RegisterCard;