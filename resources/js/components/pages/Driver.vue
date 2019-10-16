<template>
<div class="w-100 driver-container">
    <div v-if="!this.loading.data" class="card justify-content-center align-items-center p-3 d-flex w-100 h-100">
        <Spinner/>
    </div>
    <div class="driver-page card p-3" v-if="this.loading.data">
        <Goback></Goback>
        <div class="w-100 card d-flex justify-content-center flex-wrap flex-row">
            <figure class="w49 hfull p-3">
                <img :src="this.driver.photo" class="w-100">
            </figure>
            <div class="w49 p-4 data-block" v-if="!editMode">
                <h2>Водитель</h2>
                <span class="id-top">id водителя: {{this.driver.id}}</span>
                <h3><span>Имя водителя:</span> {{this.driver.name}}</h3>
                <h3><span>Фамилия водителя:</span> {{this.driver.last_name}}</h3>
                <h3><span>Телефон водителя:</span> +{{this.driver.phone}}</h3>
                <button @click.prevent="deleteDriver" class="btn btn-danger">Удалить</button>
                <button @click.prevent="toggleEditMode" class="btn btn-outline-primary">Редактировать водителя</button>
            </div>
            <div class="w49 p-4 data-block" v-if="editMode">
                <h2>Водитель</h2>
                <span class="id-top">id водителя: {{this.driver.id}}</span>
                <h3><span>Имя водителя:</span> <input type="text" v-model="driver.name"></h3>
                <h3><span>Фамилия водителя::</span> <input type="text" v-model="driver.last_name"></h3>
                <h3><span>Телефон водителя:</span> <input type="text" v-model="driver.phone"></h3>
                <h3><span>Картинка водителя:</span> <input type="file" @change="onImageSelected"></h3>

                <button @click.prevent="updateDriver" class="btn btn-outline-primary">Сохранить</button>
                <button @click.prevent="toggleEditMode" class="btn btn-outline-secondary">Выйти из режима редактирования</button>
            </div>
            <LoadingSpinner :props="{driver_id: this.driver.id}">
                <template slot-scope="{changeLoadingStatus, props}">
                    <CarBlock :driver_id="props.driver_id" :changeLoadingStatus="changeLoadingStatus"></CarBlock>
                </template>
            </LoadingSpinner>

        </div>
    </div>
</div>
</template>

<script>
    import Spinner from "../common/spinner";
    import CarBlock from "../custom/CarBlock";
    import LoadingSpinner from "../common/LoadingSpinner/LoadingSpinner";
    import Goback from "../common/goback";
  export default {
    name: "Driver",
    components: {Goback, LoadingSpinner, CarBlock, Spinner},
    props: ['id'],

    data(){
        return {
          loading: {
            data: false
          },
          driver: {
            id: '',
            name: '',
            last_name: '',
            photo: '',
            phone: ''
          },
          editMode: false,
          imageSelected: null
        }
    },
    async created() {
      await this.getDriver();
      this.loading.data = true;
    },
    methods: {
      async getDriver() {
        await fetch(`/api/driver/${this.id}`)
          .then(res => res.json())
          .then(res => this.driver = res.data)
          .catch(err => console.log(err));
      },
      async deleteDriver() {
        if(confirm("Вы точно хотите удалить?")){
          await fetch(`/api/driver/${this.driver.id}`,  {
            method: 'delete'
          })
            .then(res => res.json())
            .then(data => {
              alert(`${this.driver.name} удален`);
              window.location.href = '/home/drivers';
            })
            .catch(err => console.log(err));
        }
      },
      async updateDriver() {
        let driver = this.driver;
          await fetch(`/api/driver/`,  {
            method: 'put',
            body: JSON.stringify(driver),
            headers: {
              'Content-Type': 'application/json'
            }
          })
            .then(res => res.json())
            .then(data => {
              alert(`${this.driver.name} обновлен`);
              window.location.href = '/home/drivers';
            })
            .catch(err => console.log(err));
      },
      toggleEditMode(){
        this.editMode = !this.editMode;
      },
      onImageSelected(e){
        this.imageSelected = e.target.files[0]
      }
    }
  }
</script>

<style scoped>

</style>
