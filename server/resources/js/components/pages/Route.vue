<template>
    <div class="w-100 driver-container">
        <div v-if="!this.loading.data" class="card justify-content-center align-items-center p-3 d-flex w-100 h-100">
            <Spinner/>
        </div>
        <div class="driver-page card p-3" v-if="this.loading.data">
            <Goback></Goback>
            {{this.route.name}}
        </div>
    </div>
</template>

<script>
  import Spinner from "../common/spinner";
  import Goback from "../common/goback";
  export default {
    name: "Route",
    components: {Goback, Spinner},
    props: ['id'],

    data(){
      return {
        loading: {
          data: false
        },
        route: {
          id: '',
          name: '',
          latitude: '',
          longitude: ''
        },
        editMode: false,
        imageSelected: null
      }
    },
    async created() {
      await this.getRoute();
      this.loading.data = true;
    },
    methods: {
      async getRoute() {
        await fetch(`/api/route/${this.id}`)
          .then(res => res.json())
          .then(res => this.route = res.data)
          .catch(err => console.log(err));
      },
      async deleteRoute() {
        if(confirm("Вы точно хотите удалить?")){
          await fetch(`/api/route/${this.route.id}`,  {
            method: 'delete'
          })
            .then(res => res.json())
            .then(data => {
              alert(`${this.route.name} удален`);
              window.location.href = '/home/drivers';
            })
            .catch(err => console.log(err));
        }
      },
      async updateRoute() {
        let route = this.route;
        await fetch(`/api/route/`,  {
          method: 'put',
          body: JSON.stringify(route),
          headers: {
            'Content-Type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            alert(`${this.route.name} обновлен`);
            window.location.href = '/home/routes';
          })
          .catch(err => console.log(err));
      },
      toggleEditMode(){
        this.editMode = !this.editMode;
      }
    }
  }
</script>
