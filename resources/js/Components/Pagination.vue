<template>
  <nav class="pages-container" :class="extraClass" id="pagination">
    <ul class="pages">
      <button :disabled="prevDisabled" type="button" class="page prev" @click="handleClickControl(-1)">{{ pre }}</button>
        <template v-if="showPages">
            <li
            class="page"
            v-for="(item, index) in pages"
            :key="index"
            :class="{ ellipsis: item === ellipsis, active: item === currentPage }"
            @click="handleClickActive(item)"
            >
                <button type="button">{{ item }}</button>
            </li>
        </template>
      <button :disabled="nextDisabled" type="button" class="page next" @click="handleClickControl(+1)">{{ next }}</button>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    total:{
      type: Number,
      required: true,
    },
    current:{
      type: Number,
      required: true,
    },
    onPageChange: {
      type: Function,
    },
    extraClass: {
      type: String,
      default: "",
    }
  },
  data() {
    return {
      totalPages: this.total,
      currentPage: this.current,
      ellipsis: "···",
      pre: "Anterior",
      next: "Siguiente",
      showPages: true,
    };
  },
  computed: {

    pages() {
      const c = this.currentPage;
      const t = this.totalPages;
      if (t <= 11) {
        const pages = [];
        for (let i = 1; i <= t; i++) {
          pages.push(i);
        }
        return pages;
      } else {
        let pages = [];
        if (c <= 5) {
          pages = [1, 2, 3, 4, 5, this.ellipsis, t];
        } else if (c >= t - 4) {
          pages = [1, this.ellipsis, t - 4, t - 3, t - 2, t - 1, t,];
        } else {
          pages = [1, this.ellipsis, c - 1, c, c + 1, this.ellipsis, t,];
        }
        return pages;
      }
    },
    nextDisabled() {
       return this.currentPage === this.totalPages;
    },
    prevDisabled() {
       return this.currentPage === 1;
    },

  },
  methods: {
    handlePageChange () {
       this.onPageChange(this.currentPage);
    },
    handleClickActive(page) {
      if (page === this.currentPage || page === this.ellipsis) return;
      this.currentPage = page;
      this.handlePageChange()
    },
    handleClickControl(n) {
      this.currentPage += n;
      this.handlePageChange()
    },
  },
  mounted() {
    if(window.innerWidth < 520 ){
       this.showPages = false;
    }
  },

};
</script>

<style scoped>
.pages-container {
  --theme-color: #2d88ff;
  --background-color: #fff;
  --border-color: #dee2e6;
}
.dark .pages-container {
  --theme-color: #235487;
  --background-color: #121212;
  --border-color: #444546;
}

.pages-container .pages {
  position: relative;
  padding: 20px 0;
  text-align: center;
  white-space: nowrap;
}
.pages-container .prev {
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
}
.pages-container .next {
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
}
.pages-container .pages .page {
  height: 38px;
  min-width: 38px;
  background-color: var(--background-color);
  border: 1px solid var(--border-color);
  color: var(--theme-color);
  display: inline-block;
  line-height: 38px;
  text-align: center;
  font-size: 16px;
  text-decoration: none;
  cursor: pointer;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.pages-container .pages .page:first-child,
.pages-container .pages .page:last-child {
  padding: 0 16px;
}
.pages-container .pages .page:hover {
  background-color: var(--theme-color);
  border-color: var(--theme-color);
  color: var(--background-color);
  opacity: 0.5;
}
.pages-container .pages .active {
  background-color: var(--theme-color);
  border-color: var(--theme-color);
  color: var(--background-color);
}
.pages-container .pages .active:hover {
  opacity: 1;
}
.pages-container .pages .ellipsis {
  background-color: var(--background-color);
  border: 1px solid var(--border-color);
  color:gray;
  font-size: 16px;
  pointer-events: none;
}
.next:disabled,.prev:disabled{
  color: #717171 !important;
  pointer-events: none;
}


</style>
