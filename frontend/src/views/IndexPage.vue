<template>
  <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
    <div role="status" v-show="isLoading">
      <svg class="inline mr-2 w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
      </svg>
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
  <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 ">
    <div class="mb-6">
      <h1 class="text-grey-darkest">Task List</h1>
      <div class="flex mt-4">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" v-model="newTask" @keyup.enter="addTask" placeholder="Add New Task">
        <button class="flex-no-shrink p-2 border-2 rounded text-teal border-teal hover:text-white hover:bg-teal" @click="addTask" :disabled="newTask.length === 0">Add</button>
      </div>
    </div>
    <div class="max-h-screen-1/2 overflow-y-scroll">
      <task-item v-for="(task, index) in tasks" :key="task.id + '_' + task.name" :task="task" :index="index"
                 @remove-task="removeTask"
                 @update-task="updateTask"
      ></task-item>
      <div v-show="tasks.length === 0">
        <p class="w-full text-center text-grey-dark">There are no tasks</p>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import taskItem from '../components/TaskItem'
import { useStore } from "vuex";

export default {
  name: "IndexPage",

    components: {
      taskItem
    },

  data: () => ({
    newTask: '',
  }),

    setup() {
      const store = useStore();

      async function getTasks() {
        try {
          await store.dispatch('getTasks').then(() => {

          }).catch((err) => {
            console.log(err);
          })
        } catch (error) {
          console.error('getTasks', error);
        }
      }
      setTimeout(() => {
        getTasks()
      }, 10000);

      return {
        getTasks,
      };
    },

    created() {
      this.getTasks();
    },

    computed: {
      tasks() {
        return this.$store.state.tasks.tasks
      },
      isLoading() {
        return this.$store.state.tasks.isLoading
      }
    },

    methods: {
       createTask(text) {
         this.$store.dispatch('storeTask', text).then(() => {
        }).catch((err) => {
          console.log(err);
        })
      },

      async updateTask(details) {
        await this.$store.dispatch('editTask', details).then(() => {
          this.$store.dispatch('getTasks')
        }).catch((err) => {
          console.log(err);
        })
      },

      async removeTask(details) {
        await this.$store.dispatch('deleteTask', details.id).then(() => {
          }).catch((err) => {
            console.log(err);
          })
      },
      addTask() {
        if(this.newTask.length > 0) {
          this.createTask(this.newTask);
          this.newTask = '';
        }
      },
    },
}
</script>

<style scoped>

</style>