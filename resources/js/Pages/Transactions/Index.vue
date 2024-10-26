<template>
    <div class="transaction-list">
        <h1>Транзакции</h1>
        <a class="btn" href="/transaction/create">Добавить транзакцию</a>

        <div class="filter">
            <div class="filter-group">
                <label for="startDate">С начала:</label>
                <input type="date" v-model="startDate" @change="filterTransactions" />
            </div>
            <div class="filter-group">
                <label for="endDate">По конец:</label>
                <input type="date" v-model="endDate" @change="filterTransactions" />
            </div>
            <button @click="filterTransactions" class="btn-filter">Применить</button>
        </div>

        <div class="summary">
            <h2>Итого</h2>
            <p class="income">Доходы: {{ totalIncome }} руб.</p>
            <p class="expense">Расходы: {{ totalExpense }} руб.</p>
        </div>

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
            <tr v-for="transaction in filteredTransactions" :key="transaction.id">
                <td>{{ transaction.category }}</td>
                <td>{{ transaction.amount }}</td>
                <td>{{ transaction.date }}</td>
                <td>{{ transaction.description }}</td>
                <td>
                    <div class="action-buttons">
                        <a class="btn-edit" :href="`/transaction/${transaction.id}/edit`">Редактировать</a>
                        <form @submit.prevent="destroy(transaction.id)" class="form-delete">
                            <button type="submit" class="btn-delete">Удалить</button>
                        </form>
                    </div>
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
    data() {
        return {
            startDate: '',
            endDate: '',
            filteredTransactions: this.transactions,
        };
    },
    computed: {
        totalIncome() {
            return this.filteredTransactions.filter(t => t.category === 'income').reduce((sum, t) => sum + t.amount, 0);
        },
        totalExpense() {
            return this.filteredTransactions.filter(t => t.category === 'expense').reduce((sum, t) => sum + t.amount, 0);
        },
    },
    methods: {
        async destroy(id) {
            if (confirm('Вы уверены, что хотите удалить эту транзакцию?')) {
                await this.$inertia.delete(`/transaction/${id}`);
                this.filteredTransactions = this.filteredTransactions.filter(transaction => transaction.id !== id);
            }
        },
        filterTransactions() {
            const start = this.startDate ? new Date(this.startDate) : null;
            const end = this.endDate ? new Date(this.endDate) : null;

            this.filteredTransactions = this.transactions.filter(transaction => {
                const transactionDate = new Date(transaction.date);
                return (!start || transactionDate >= start) && (!end || transactionDate <= end);
            });
        },
    },
    mounted() {
        this.filteredTransactions = this.transactions;
    },
};
</script>

<style scoped>
.transaction-list {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.btn {
    margin-top: 20px;
    margin-bottom: 20px;
    padding: 10px 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #45a049;
}

.btn-filter {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-filter:hover {
    background-color: #0056b3;
}

.btn-edit {
    margin-right: 15px;
    background-color: #ffc107;
    color: white;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-edit:hover {
    background-color: #e0a800;
}

.btn-delete {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
}

.btn-delete:hover {
    background-color: #d32f2f;
}

.filter {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
}

.filter-group {
    margin-right: 20px;
}

.summary {
    margin-bottom: 20px;
    background-color: #e9ecef;
    padding: 10px;
    border-radius: 5px;
}

.income {
    color: #28a745;
    font-weight: bold;
}

.expense {
    color: #dc3545;
    font-weight: bold;
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

.action-buttons {
    display: flex;
    gap: 10px;
}
</style>
