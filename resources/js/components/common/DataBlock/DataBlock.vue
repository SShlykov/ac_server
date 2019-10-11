<template>
    <div class="w-100">
        <div class="row">
            <h2>{{title}}</h2>
            <a href="javascript:history.go(-1)">back</a>
        </div>
        <div class="d-flex flex-wrap container-fluid w-100">
            <div class="card card-body m-1" v-for="item in data.list" v-bind:key="item.id" style="width: 18rem;">
                <slot :item="item" :deleteItem="deleteItem" />
            </div>
            <nav aria-label="Page navigation example" class="w-100 d-flex justify-content-end">
                <ul class="pagination">
                    <li :class="[{disabled: !data.pagination.prev_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchData(data.pagination.prev_page_url)">
                            Предыдущий
                        </a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link text-dark" href="#" >
                            {{data.pagination.current_page}} из {{data.pagination.last_page}}
                        </a>
                    </li>
                    <li :class="[{disabled: !data.pagination.next_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchData(data.pagination.next_page_url)">
                            Следующий
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</template>

<script>
export default {
  props: {
    'title': {
      required: true
    },
    'path': {
      required: true
    }
  },
  name: 'DataBlock',
  data() {
    return{
      data : {
        id: '',
        list: [],
        curr_item:{},
        pagination: {},
        edit: false
      }
    }
  },
  created() {
    this.fetchData();
  },
  updated(){
    console.log(this.data)
  },
  methods: {
    fetchData(page_url) {
      let vm = this;
      page_url = page_url || `/api/${this.path}/6`;
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.data.list = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.warn(err));
    },
    makePagination(meta, links){
      this.data.pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
    },
    deleteItem(id){
        if(confirm("Вы точно хотите удалить?")){
          fetch(`/api/${this.path.slice(0, -1)}/${id}`,  {
            method: 'delete'
          })
            .then(res => res.json())
            .then(data => {
              alert(`${this.title} удален`)
              this.fetchData()
            })
            .catch(err => console.log(err));
        }
    }
  },
}
</script>
