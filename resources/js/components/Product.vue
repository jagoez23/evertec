<template>
    <div>
        <h1 class="text-center">Lista de Productos</h1>
        <hr/>

        <!-- Button trigger modal -->
        <button @click="update=false;  openModal();" type="button" class="btn btn-primary my-4">
        Nuevo Producto
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
                <form enctype="multipart/form-data">
                <div class="my-4">
                    <label for="name">Nombre</label>
                    <input v-model="product.name" type="text" class="form-control" id="name" placeholder="Nombre del producto" name=""  >
                </div>
                <div class="my-4">
                    <label for="description">Descripión</label>
                    <input v-model="product.description" type="text" class="form-control" id="description" placeholder="Descripción del producto" name=""  >
                </div>
                <div class="my-4">
                    <label for="price">Precio</label>
                    <input v-model="product.price" type="text" class="form-control" id="price" placeholder="Precio del producto" name=""  >
                </div>
                <div class="my-4">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control" ref="file" v-on:change="onUploadImage()" placeholder="Imagen del producto" name=""  >
                </div>
                </form>
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
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Imagen</th>
                    <th scope="col" colspan="2" class="text-center">Acción</th>  
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                <td>{{product.name}}</td>
                <td>{{product.description}}</td>
                <td>{{product.price}}</td>
                <td>{{product.image}}</td>
                <td>
                    <button @click="update=true; openModal(product);" class="btn btn-warning">Editar</button>  
                </td>
                <td> 
                    <button @click="eliminar(product.id)" class="btn btn-danger">Eliminar</button>
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
              product:{
                 name:'',
                 description:'',
                 price:'',
                 image:'',
                },
                id:0,
                update:true,
                modal:0,
                titleModal:'',
                products:[],
            };  
        },
        methods: {
         async list() {
            const res = await axios.get('product');
            this.products = res.data;
          },
          async eliminar(id) {
            const res = await axios.delete('/product/'+id);
            this.list();
          },
          async save() { 

              if(this.update){
                   const res = await axios.put('/product/' +this.id, this.product);
                }else{
                   const res = await axios.post('/product/', this.product);
                }
              this.closeModal();
              this.list();
            },
            openModal(data={}){
              this.modal=1;
              if(this.update) {
                 this.id = data.id;
                 this.titleModal="Modificar Producto";
                 this.product.name = data.name;
                 this.product.description = data.description;
                 this.product.price = data.price;
                 this.product.image = data.image;
                }else{
                 this.id = 0;
                 this.titleModal="Crear Producto";
                 this.product.name = '';
                 this.product.description = '';
                 this.product.price = '';
                 this.product.image = '';
                }
            },
            closeModal(){
             this.modal=0;
            },
            onUploadImage() {
                this.picFile = this.$refs.file.files[0];
            },  
        },
        created() {
         this.list();
        },
    };     
</script>

<style >
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(44,38,75,0.849);
}
</style>
