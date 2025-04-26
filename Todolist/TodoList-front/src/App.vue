<script setup lang="ts">
import {deleteTask, getAllTasks, updateTask, createTask} from "@/services/api.ts";
import {onMounted, ref} from "vue";

const taskList = ref(null);
const descriptionData = ref(null);

const fetchTasks = () => {
  getAllTasks().then((res) => {
      taskList.value = res.data.map(task => ({
          ...task,
          isEditing: false,
        })
      );
    }
  )
}

onMounted(() => {
    if (taskList.value === null) {
      fetchTasks();
    }
  }
)

function toggleEditor(index) {
  taskList.value[index].isEditing = !taskList.value[index].isEditing;
}

function updTask(taskId, event) {
  const formData = new FormData(event.target);

  if (event.target) {
    updateTask(taskId, {
      text: formData.get('newDescription')
    }).then((res) => {
      const theIndex = taskList.value.findIndex((oldTask) => oldTask.id === res.data.data.id);

      taskList.value[theIndex] = {...res.data.data, isEditing: false,};
    });
  }
}

function creatTask(event) {
  const formData = new FormData(event.target);

  if (event.target) {
    createTask({
      text: formData.get('description')
    }).then(() => {
      fetchTasks();
      descriptionData.value = null;
    });
  }
}

function delTask(taskId) {
  deleteTask(taskId)
    .then(() => {
      const theIndex = taskList.value.findIndex((oldTask) => oldTask.id === taskId);

      taskList.value.splice(theIndex, 1);
    });
}

</script>

<template>
  <body class="bg-gray-100">
  <div class="container mx-auto py-10 px-4">
    <!-- Header -->
    <header class="text-center mb-12">
      <h1 class="text-4xl font-bold">My Checklist</h1>
      <p class="text-lg text-gray-600">Organize your tasks efficiently</p>
    </header>

    <div class="flex flex-col items-center justify-center space-y-8">

      <div class="bg-white shadow-sm rounded-lg w-[40vw]">
        <div class="p-6">
          <h5 class="text-xl font-semibold mb-4">Your Tasks</h5>
          <ul class="space-y-2" id="taskList">
            <!-- If tasks exists-->
            <!-- Print all tasks-->
            <li v-if="taskList && taskList.length !== 0"
                v-for="(task, index) in taskList" :key="task.id"
                class="bg-white border border-gray-200 rounded-md p-4 flex items-center justify-between">
              <span v-if="!task.isEditing" class="w-full">{{ task.text }}</span>
              <div v-if="!task.isEditing" id="task-desc- "
                   class="flex gap-3 items-center justify-between">
                <span class="pl-3 w-full text-left"></span>
                <button @click="toggleEditor(index)"
                        class="text-sm px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                  Update
                </button>

                <!-- delete -->
                <form @submit.prevent>

                  <button @click="delTask(task.id)"
                          class="text-sm px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete
                  </button>
                </form>

              </div>

              <!--UPdate-->
              <div v-else id="updateArea- " class="flex w-full items-center justify-between">
                <form @submit.prevent="updTask(task.id, $event)" class="flex w-full gap-3 pr-3">
                  <input type="text" class="flex-1 border border-gray-300 rounded px-3 py-2"
                         name="newDescription" id="newDescription" :value="task.text"
                         placeholder="Enter your task here">
                  <button
                    class="text-sm px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Save
                  </button>
                </form>

                <button @click="toggleEditor(index)"
                        class="text-sm px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                  &times;
                </button>
              </div>
            </li>

            <!-- @else if not tasks-->
            <li v-else class="text-center text-gray-500">No tasks available.</li>

          </ul>
        </div>
      </div>

      <!-- Add Task Form -->
      <div class="bg-white shadow-sm rounded-lg w-[40vw]">
        <div class="p-6">
          <h5 class="text-xl font-semibold mb-4">Add a New Task</h5>

          <form @submit.prevent="creatTask($event)" id="addTaskForm">
            <div class="mb-4">
              <label for="taskInput"
                     class="block mb-1 text-gray-700 font-medium">Description</label>
              <input type="text" v-model="descriptionData" class="w-full border border-gray-300 rounded px-3 py-2"
                     name="description" id="description" placeholder="Enter your task here"
                     required>
            </div>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Task
            </button>
          </form>

        </div>
      </div>

    </div>
  </div>
  </body>
</template>

<style scoped>

</style>
