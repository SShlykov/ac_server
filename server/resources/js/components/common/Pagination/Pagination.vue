<template>
    <nav aria-label="Page navigation example" class="w-100 d-flex justify-content-end">
        <ul class="pagination">
            <li :class="[{disabled: !this.pagination.prev_page_url}]" class="page-item">
                <a class="page-link" href="#" @click="previousPage">
                    Предыдущий
                </a>
            </li>
            <li class="page-item disabled">
                <a class="page-link text-dark" href="#" >
                    {{this.pagination.current_page}} из {{this.pagination.last_page}}
                </a>
            </li>
            <li :class="[{disabled: !this.pagination.next_page_url}]" class="page-item">
                <a class="page-link" href="#" @click="nextPage">
                    Следующий
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
  export default {
    props: {
      pagination: {
        required: true
      },
      fetchData: {
        required: true
      }
    },
    name: "Pagination",
    methods: {
      nextPage() {
        this.fetchData(this.pagination.next_page_url)
      },
      previousPage() {
        this.fetchData(this.pagination.prev_page_url)
      }
    }
  }
</script>

<style scoped>

</style>
