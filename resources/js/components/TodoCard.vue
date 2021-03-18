<template>
    <el-card class="box-card" v-for="tarea in tareas">
        <div>
            <el-input v-if="tarea.id === editId" type="text" v-model="formEdit.title" maxlength="20" show-word-limit clearable></el-input>
            <span v-else v-text="tarea.title"></span>
        </div>
        <el-input v-if="tarea.id === editId" type="text" v-model="formEdit.content" maxlength="60" show-word-limit></el-input>
        <div v-else class="text item" v-text="tarea.content"></div>
        <div>
            <!-- los : significa v-bind y es para indicar que es un entero, :true-label="1" -->
            <el-checkbox v-if="tarea.id !== editId" @change="postData(tarea)" v-model="tarea.completed" label="Completado" border></el-checkbox>
        </div>
        <div>
            <span v-if="tarea.id !== editId" v-text="changeDate(tarea.updated_at)"></span>
        </div>
        <div>
            <template v-if="tarea.id === editId">
                <el-button @click="postData(tarea)" type="primary" icon="el-icon-document-add"></el-button>
                <el-button @click="cancelEdit()" type="danger" icon="el-icon-close"></el-button>
            </template>
            <template v-else>
                <el-button type="primary" icon="el-icon-edit" @click="selectEdit(tarea)"></el-button>
                <el-button @click="deleteData(tarea)" type="danger" icon="el-icon-delete"></el-button>
            </template>
        </div>
    </el-card>
</template>

<script>
import moment from 'moment';

export default {
    name: "TodoCard",
    props: ['tareas'],
    data(){
      return {
          editId: null,
          formEdit: {}
      }
    },
    methods: {
        postData(tarea) {
            axios.put('/updateTodo/' + tarea.id, tarea)
                .then(response => {
                    this.editId = null;
                    console.log(response.data)
                }).catch(error => {
                console.log(error.response)
            });
        },
        deleteData(tarea) {
            axios.delete(/deleteTodo/ + tarea.id, tarea)
                .then(response => {
                    console.log(response.data);
                    for (var i = 0; i < this.tareas.length; i++) {
                        if (this.tareas[i].id === tarea.id) {
                            this.tareas.splice(i, 1);
                        }
                    }
                }).catch(error => {
                console.log(error.response)
            });
        },
        changeDate(fecha) {
            return moment(fecha).format('DD/MM/YYYY')
        },
        selectEdit(tarea){
            this.editId = tarea.id;
            this.formEdit = tarea;
        },
        cancelEdit(){
            this.editId = null;
        }
    }
}
</script>

<style scoped>
.box-card {
    margin: 10px 0;
}
</style>
