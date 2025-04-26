import axios from "axios";

const base = 'http://todolist-back.test/api/tasks';

export const getAllTasks = async () => {
  try {
    return axios.get(`${base}`)
      .then((response) => {
        return response.data;
      });
  } catch (error) {
    console.log("We didn't fetch the tasks:", error);
  }
};

export const createTask = async (data) => {
  try{
    await axios.post(`${base}`, data);
  }
  catch(error){
    console.log('Task error:',error);
  }
};

export const updateTask = async (id, data) => {
  try {
    return axios.put(`${base}/${id}`, data);
  } catch {
    console.log('Task update error:', error);
  }
};

export const deleteTask = async (id) => {
  try {
    await axios.delete(`${base}/${id}`);
  } catch (error) {
    console.log('Task delete error:', error);
  }
};
