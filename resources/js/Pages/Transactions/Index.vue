<template>
    <div class="transaction-list">
        <h1>Транзакции</h1>
        <a class="btn" href="/transaction/create">Добавить транзакцию</a>

        <table>
            <thead>
            <tr>
                <th>Категория</th>
                <th>Сумма</th>
                <th>Дата</th>
                <th>Описание</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="transaction in transactions" :key="transaction.id">
                <td>{{ transaction.category }}</td>
                <td>{{ transaction.amount }}</td>
                <td>{{ transaction.date }}</td>
                <td>{{ transaction.description }}</td>
                <td>
                    <a class="btn-edit" :href="`/transaction/${transaction.id}/edit`">Редактировать</a>
                    <form @submit.prevent="destroy(transaction.id)" class="form-delete">
                        <button type="submit" class="btn-delete">Удалить</button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        transactions: Array,
    },
    methods: {
        async destroy(id) {
            if (confirm('Вы уверены, что хотите удалить эту транзакцию?')) {
                await this.$inertia.delete(`/transaction/${id}`);
            }
        },
    },
};
</script>

<style scoped>
.transaction-list {
    padding: 20px;
}

.btn {
    margin-top: 20px; /* Увеличиваем отступ сверху */
    margin-bottom: 20px; /* Увеличиваем отступ снизу */
    padding: 10px 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block; /* Чтобы кнопка воспринималась как блок */
}

.btn-edit {
    margin-right: 5px;
    background-color: #2196F3;
}

.btn-delete {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}
</style>

