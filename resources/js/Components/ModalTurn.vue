<script setup>
    import { useForm } from '@inertiajs/vue3';
    import TextInput from '@/Components/TextInput.vue';
    import CheckBox from '@/Components/Checkbox.vue';       
    const props = defineProps({
        turn:{type:Object, default:() => ({})},
        modal:String,title:String,op:String
    });
    const form = useForm({
        id:props.turn.id,turn:props.turn.turn,status:props.turn.status
    });
    const save = () =>{
        form.post(route('turns.store'),{
            onSuccess: () => cerrar()
        });
    }
    const update = () =>{
        var id = document.getElementById('id2').value;
        form.put(route('turns.update',id),{
            onSuccess: () => cerrar()
        });
    }
    const cerrar = () =>{
        form.reset();
        document.querySelector('#cerrar'+props.op).click();
    };    
</script>
<template>
    <div class="modal fade" :id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <lavel class="h5">{{ title }}</lavel>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="(op === '1' ? save() : update())">
                        <TextInput :id="'id'+op" type="hidden" name="id" v-model="form.id"></TextInput>
                        <div>
                            <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                            <TextInput :id="'turn'+op" class="form-control" type="text" name="turn" v-model="form.turn" maxlength="12" placeholder="Turno" required></TextInput>
                        </div>
                        <div v-if="form.errors.turn" class="text-sm text-danger">
                            {{ form.errors.turn }}
                        </div>
                        <div>
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <CheckBox :id="'status'+op" name="status" v-model="form.status"></Checkbox>
                        </div>   
                        <div v-if="form.errors.status" class="text-sm text-danger">
                            {{ form.errors.status }}
                        </div>  
                        <div class="d-grid mx-auto">
                            <button class="btn btn-success" :disabled="form.processing">
                                <i class="fa-solid fa-floppy-disk"></i> Guardar
                            </button>
                        </div>                                                                   
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" type="submit" :id="'cerrar'+op" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</template>