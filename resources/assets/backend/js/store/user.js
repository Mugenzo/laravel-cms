import {computed, ref} from "vue";
import {defineStore} from "pinia";

export const useUserStore = defineStore('user', () => {
    const user = ref({
        id: null,
        role: 'guest',
        name: ''
    })

    const id = computed(() => user.value.id)
    const name = computed(() => user.value.name)
    const role = computed(() => user.value.role)

    return { id, name, role, user }
})
