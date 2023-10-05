import axios from 'axios';
import {APP_TOKEN} from "@/constants";

const axiosInstance = axios.create({
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'app-token': APP_TOKEN,
    }
});

export default axiosInstance;