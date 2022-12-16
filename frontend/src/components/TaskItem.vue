<template>
    <div class="mb-4">
      <div class="flex items-center w-full">
        <p
            class="appearance-none  rounded w-full py-2 px-3 mr-2"
           :class="task.status === TASK_STATUS.done
           ? 'line-through text-green'
           : 'text-grey-darkest cursor-pointer hover:text-black hover:font-bold'">
          {{task.name}}
        </p>
        <button
            v-show="task.status === TASK_STATUS.done"
            @click="updateTask('progress')"
            class="flex-no-shrink p-2 ml-4 mr-2 border-2 rounded hover:text-white text-grey border-grey hover:bg-grey"
        >
          Not Done
        </button>
        <button
            v-show="task.status === TASK_STATUS.progress"
            @click="updateTask('completed')"
            class="flex-no-shrink p-2 ml-4 mr-2 border-2 rounded hover:text-white text-green border-green hover:bg-green"
        >
          Done
        </button>
        <button
            class="flex-no-shrink p-2 ml-auto border-2 rounded text-red border-red hover:text-white hover:bg-red"
            @click="remove(index)"
        >
          Remove
        </button>
        <div class="appearance-none rounded w-full py-2 px-3 mr-2 text-black"> <p class="py-2 px-3 mr-2"> expires on: {{ task.expires_at }}</p></div>

      </div>
    </div>
</template>

<script>
import TASK_STATUS from "@/constants/enum/TASK_STATUS";

export default {
  name: "TaskItem",
  computed: {
    TASK_STATUS() {
      return TASK_STATUS
    }
  },

  props: ['task', 'index'],

  data: () => ({
    data: {
      name: '',
    }
  }),

  mounted() {
    this.data.name = this.task.name;
  },

  methods: {
    async updateTask(status) {
      this.$emit('update-task', { index: this.index, id: this.task.id, status });
    },

    remove() {
      this.$emit('remove-task', { index: this.index, id: this.task.id });
    },
  }

}
</script>

<style scoped>

</style>