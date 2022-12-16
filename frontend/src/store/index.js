import {createStore} from 'vuex'
import Axios from "axios";

const host = '//localhost/api'
import tasks from './modules/tasks'
export default createStore({

    modules: {
        tasks,
    }
})