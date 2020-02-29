<template>
<div>
    <div class="card w-100 p-3 data-block d-flex justify-content-between flex-row flex-wrap" v-if="this.car.id">
        <div class="w-100"> <h2>Автомобиль</h2></div>
        <div class="w49 p-4 data-block">
            <span class="id-top">id машины: {{this.car.id}} </span>
            <h3><span>Название машины:</span> {{this.car.name}} </h3>
            <h3><span>Тип автомобиля:</span> {{this.car.type}} </h3>
            <h3><span>Топливо:</span> {{this.car.fuel}} </h3>
        </div>
        <div class="w49 p-4 data-block">
            <h3><span>Стоимость за 1 км:</span> {{this.car.price}} </h3>
            <h3><span>Количество мест:</span> {{this.car.sits}} </h3>
            <h3><span>Детское кресло (кол-во):</span> {{this.car.child}} </h3>
        </div>
        <LoadingSpinner :props="{car_id: this.car.id}">
            <template slot-scope="{changeLoadingStatus, props}">
                <CarPhotoBlock :car_id="props.car_id" :changeLoadingStatus="changeLoadingStatus"></CarPhotoBlock>
            </template>
        </LoadingSpinner>
    </div>
</div>
</template>

<script>
  import Spinner from "../common/spinner";
  import CarPhotoBlock from "./CarPhotoBlock";
  import LoadingSpinner from "../common/LoadingSpinner/LoadingSpinner";
  export default {
    name: "CarBlock",
    components: {LoadingSpinner, CarPhotoBlock, Spinner},
    props: {
      driver_id: {
        required: true
      },
      changeLoadingStatus: {
        required: true
      }
    },
    data() {
      return {
        car: {
          id: '',
          child: '',
          driver_id: "",
          fuel: "",
          name: "",
          price: "",
          sits: "",
          type: ""
      },
      }
    },
      async created() {
        await this.getCar();
        this.changeLoadingStatus()
      },
    methods: {
      async getCar() {
        await fetch(`/api/car/${this.driver_id}`)
          .then(res => res.json())
          .then(res => this.car = res.data)
          .catch(err => console.log(err))
      }
    }
  }
</script>

<style scoped>

</style>
