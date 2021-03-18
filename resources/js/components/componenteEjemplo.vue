<template>
    <div class="common-layout">
        <el-container>

            <el-aside width="200px">
                <el-row>
                    <el-col :span="24">
                        <h5 v-text="'Elementos seleccionados: '+elementos"></h5>
                    </el-col>
                    <el-col :span="24">
                        <el-button type="primary" icon="el-icon-edit"></el-button>
                    </el-col>
                    <el-col :span="24">
                        <el-button type="danger" icon="el-icon-delete"></el-button>
                    </el-col>
                </el-row>
            </el-aside>

            <el-container>
                <el-header>ToDo List de David</el-header>
                <el-main>
                    <todocard v-if="tareas.length>0" :tareas="tareas"/>
                </el-main>

                <el-popover placement="top" title="Nuevo ToDo" width="50vh" v-model:visible="visible">
                    <el-input type="text" placeholder="Título" v-model="text" maxlength="20" show-word-limit
                              clearable></el-input>
                    <div style="margin: 20px 0;"></div>
                    <el-input type="textarea" placeholder="Tarea" v-model="textarea" maxlength="60"
                              show-word-limit></el-input>
                    <div style="text-align: right; margin-top: 10px;">
                        <el-button type="warning" size="mini" @click="visible = false">cancelar</el-button>
                        <el-button type="primary" size="mini" @click="visible = false; addTodo(); postData()">confirmar</el-button>
                    </div>
                    <template #reference>
                        <el-button @click="visible" type="success" icon="el-icon-plus">Añadir tarea</el-button>
                    </template>
                </el-popover>


                <el-footer v-text="fecha"></el-footer>
            </el-container>

        </el-container>
    </div>
</template>

<script>
import moment from 'moment';
import TodoCard from "./TodoCard";

export default {
    name: "componenteEjemplo",
    data() {
        return {
            fecha: moment().format('YYYY'),
            elementos: 0,
            visible: false,
            text: "",
            textarea: "",
            tareas: [],
            tarea: []
        }
    },
    components: {
        "todocard": TodoCard,
    },
    created(){
        this.getData();
    },
    methods: {
        addTodo: function () {
            if (this.text.length && this.textarea.length > 0 ){
                this.tarea.push(
                    {title: this.text, content: this.textarea, completed: false}
                );
                this.tareas.push(
                    {title: this.text, content: this.textarea, completed: false}
                );
                this.text = "";
                this.textarea = "";
            }else {
                alert("Faltan datos para crear una tarea")
            }

        },
        getData() {
            axios.get('/getData').then(data => {
                console.log(data.data);
                this.tareas = data.data;
            })
        },
        postData(){
            axios.post('/addTodo', {
                tarea: this.tarea,
            }).then(response => {
                console.log(response.data)
            }).catch(error => {
                console.log(error.response)
            });
        }
    }
}
</script>

<style scoped>

.el-header, .el-footer {
    background-color: #B3C0D1;
    color: #333;
    text-align: center;
    line-height: 60px;
}

.el-aside {
    background-color: #D3DCE6;
    color: #333;
    text-align: center;
    line-height: 200px;
}

.el-main {
    background-color: #E9EEF3;
    color: #333;
    text-align: center;
    line-height: 160px;
}

body > .el-container {
    margin-bottom: 40px;
}

.el-container:nth-child(5) .el-aside,
.el-container:nth-child(6) .el-aside {
    line-height: 260px;
}

.el-container:nth-child(7) .el-aside {
    line-height: 320px;
}
</style>
