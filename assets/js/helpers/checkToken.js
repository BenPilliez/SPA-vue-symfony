import setAuthorizationToken from "./axios";
import axios from "axios";

export default function checkToken() {
    let token = {refresh_token :  localStorage.getItem('refresh_token')};
    let connectedAt = new Date(localStorage.getItem('connect_at'));

    console.log(token);
    if (Date.now() - connectedAt >= 86400000) {
        axios({url: ' /api/token/refresh', data: token, method: 'POST'})
            .then((resp) => {
                console.log(resp.data);
                setAuthorizationToken(resp.data.token);

            })
            .catch((err) => {
                console.error(err);
            })
    }
}