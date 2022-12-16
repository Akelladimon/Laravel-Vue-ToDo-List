import defaultState from './defaultState'

export default {
  preloader(state, isLoading) {
    state.isLoading = isLoading
  },
  setTasks(state, { data }) {
    state.tasks = data
  },
  setTask(state, { data }) {
    let tasks = state.tasks
    tasks.map(task => {
      if (task.id === data.id) {
        return data
      }
      return task
    } )
    state.tasks = [ ...state.tasks, data]
  },
  updateTask(state, { data }) {
    let tasks = Object.values(state.tasks)
    state.tasks = tasks.map(task => {
      if (task.id === data.id) {
        return data
      }
      return task
    } )
  },
  deleteTask(state, id) {
    let tasks = state.tasks
    state.tasks = tasks.filter(task => task.id !== id )
  },
}
