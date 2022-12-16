import Axios from "axios";

const host = '//localhost/api'
export default {
  getTasks(store) {
    store.commit('preloader', true)

    return Axios.get(host + '/tasks')
        .then(({data}) => {
          store.commit('setTasks', data)
          store.commit('preloader', false)
        })
        .catch((err) => {
          store.commit('preloader', false)
          throw err
        })
  },
  storeTask(store, payload) {
      store.commit('preloader', true)
       Axios.post(host + '/task', { name: payload })
        .then(({data}) => {
          store.commit('setTask', data)
          store.commit('preloader', false)
          store.dispatch('getTasks')
        })
        .catch((err) => {
          store.commit('preloader', false)
          throw err
        })
  },
  editTask(store, payload) {
      store.commit('preloader', true)
      return Axios.patch(host + '/task/' + payload.id, {status: payload.status })
        .then(({data}) => {
            store.commit('preloader', false)
            store.commit('updateTask', data)

            return data;
        })
        .catch((err) => {
            store.commit('preloader', false)
            throw err
        })
  },
  deleteTask(store, payload) {
      store.commit('preloader', true)
    return Axios.post(host + '/task/' + payload, {_method: 'delete'})
        .then((data) => {
            store.commit('preloader', false)
            store.commit('deleteTask', payload)
            return data;
        })
        .catch((err) => {
            store.commit('preloader', false)
            throw err
        })
  },
}
