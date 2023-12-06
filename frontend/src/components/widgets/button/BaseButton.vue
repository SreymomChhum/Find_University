<template>
  <button :class="mode">
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: ['mode'],
};
</script>

<style scoped>
button {
  padding: 0.5rem 1rem;
  font-family: inherit;
  background-color: var(--secondary-color);
  border: 1px solid var(--secondary-color);
  color: white;
  cursor: pointer;
  border-radius:5px

}

button:hover,
button:active {
  background-color: var(--main-color-light);
  border-color: var(--main-color-light);
}

.flat {
  background-color: transparent;
  color: var(--main-color);
  border: none;
}

.flat:hover,
.flat:active {
  background-color: #edd2ff;
}
</style>