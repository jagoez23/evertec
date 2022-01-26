<template>
    <div>
        <h1 class="text-center">Lista de Usuarios</h1>
        <hr/>

        <!-- Button trigger modal -->
        <button @click="update=false;  openModal();" type="button" class="btn btn-primary my-4">
        Nuevo Usuario
        </button>

         <!-- Modal -->
        <div class="modal" :class="{mostrar:modal}">
        <div class="modal-dialog">
            <div class="modal-content">
                 <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">{{titleModal}}</h5>
                <button @click="closeModal();" type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
             <!-- Modal body -->
            <div class="modal-body">
                <div class="my-4">
                    <label for="name">Nombre</label>
                    <input v-model="user.name" type="text" class="form-control" id="name" placeholder="Nombre del Usuario" name=""  >
                </div>
                <div class="my-4">
                    <label for="email">Correo Electrónico</label>
                    <input v-model="user.email" type="text" class="form-control" id="email" placeholder="Correo Electrónico" name=""  >
                </div>
            </div>
             <!-- Modal footer --> 
            <div class="modal-footer">
                <button @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button @click="save();" type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
            </div>
            </div>
        </div>
        </div>


        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col" colspan="2" class="text-center">Acción</th>  
                </tr>
            </thead>
            <tbody>
                <tr v-for="user  in users" :key="user.id">
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>
                    <button @click="update=true; openModal(user);" class="btn btn-warning">Editar</button>  
                </td>
                <td>
                    <button @click="eliminar(user.id)" class="btn btn-danger">Eliminar</button>  
                </td>
                </tr> 
            </tbody>
        </table>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                user: {
                    nombre:'',
                    correo:'',
                },
                id:0,
                update:true,
                modal:0,
                titleModal:'',
                users:[],    
        };
    },
    methods: {
        async list() {
            const res = await axios.get('user');
            this.users = res.data;
        },
        async eliminar(id) {
            const res = await axios.delete('/user/'+id);
            this.list();

        },
        async save() {
            if(this.update){
               const res = await axios.put('/user/' +this.id, this.user);
            }else{
                const res = await axios.post('/user/', this.user);
            }
            this.closeModal();
            this.list();
        },
        openModal(data={}){
            this.modal=1;
            if(this.update) {
                this.id = data.id;
                this.titleModal="Modificar Usuario";
                this.user.name = data.name;
                this.user.email = data.email;
            }else{
                this.id = 0;
                this.titleModal="Crear Usuario";
                this.user.name = '';
                this.user.email = '';
            }
        },
        closeModal(){
            this.modal=0;
        },      
    },
    created() {
        this.list();
      },
    };
</script>


<style>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(75, 56, 143, 0.705);
}

</style>