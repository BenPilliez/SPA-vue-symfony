import setAuthorizationToken from "./axios";
import axios from "axios";

export default async function refreshToken() {

    let response = await axios({
        url: '/api/token/refresh',
        data: {refresh_token: localStorage.getItem('refresh_token')},
        method: 'POST'
    });

    if (response.status === 200) {
        return response.data;
    }
        

}