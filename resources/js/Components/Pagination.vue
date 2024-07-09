<script setup>
import { ref, computed, onMounted, watch } from "vue";
const props = defineProps({
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
});

const totalPages = ref(props.total)
const currentPage = ref(props.current)
const ellipsis = "···"
const pre = "<"
const next = ">"
const showPages = ref(true)

const pages = computed ( () => {
  const c = currentPage.value;
  const t = totalPages.value;
  if (t <= 11) {
    const pages = [];
    for (let i = 1; i <= t; i++) {
      pages.push(i);
    }
    return pages;
  } else {
    let pages = [];
    if (c <= 5) {
      pages = [1, 2, 3, 4, 5, ellipsis, t];
    } else if (c >= t - 4) {
      pages = [1, ellipsis, t - 4, t - 3, t - 2, t - 1, t,];
    } else {
      pages = [1, ellipsis, c - 1, c, c + 1, ellipsis, t,];
    }
    return pages;
  }
})
const nextDisabled = computed ( () => {
  return currentPage.value === totalPages.value;
})
const prevDisabled = computed ( () => {
  return currentPage.value === 1;
})

const handlePageChange =  () => {
  props.onPageChange(currentPage.value);
}
const handleClickActive = (page) => {
  if (page === currentPage.value || page === ellipsis) return;
  currentPage.value = page;
  handlePageChange()
}
const handleClickControl = (n) => {
  currentPage.value += n;
  handlePageChange()
}

onMounted(() => {
  if(window.innerWidth < 520 ){
    showPages.value = false;
  }
})

watch(
  () => props.current,
  () => {
    currentPage.value = props.current
  },
)
watch(
  () => props.total,
  () => {
    totalPages.value = props.total
  },
)

</script>
<template>
  <nav :class="[extraClass,'pages-container']" id="pagination">
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

<style scoped>

.pages-container {
    --bg-selected: #030c57;
    --bg-hover: #030c5780;
    --background-color: white;
    --border-color: #030c5770;
    --text-color: #030c57;
    --text-selected: white;
}
.dark .pages-container {
  --bg-hover: #0067C2;
  --bg-selected: #004480;
  --background-color: #1e1e1e;
  --border-color: #444546;
  --text-color: white;
  --text-selected: #CED1D4;
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
  color: var(--text-color);
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
  background-color: var(--bg-hover);
  border-color: var(--bg-hover);
  color: var(--text-selected);
}
.pages-container .pages .active {
  background-color: var(--bg-selected);
  border-color: var(--bg-selected);
  color: var(--text-selected);
}
.pages-container .pages .active:hover {
  background-color: var(--bg-selected);
  border-color: var(--bg-selected);
  color: var(--text-selected);
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
