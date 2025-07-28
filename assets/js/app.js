// Máscaras de input
document.addEventListener('DOMContentLoaded', function() {
    // Controle de tema (claro/escuro)
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');

    function applyTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            themeIcon?.classList.remove('fa-moon');
            themeIcon?.classList.add('fa-sun');
        } else {
            document.body.classList.remove('dark-mode');
            themeIcon?.classList.remove('fa-sun');
            themeIcon?.classList.add('fa-moon');
        }
    }

    const storedTheme = localStorage.getItem('theme');
    if (storedTheme) {
        applyTheme(storedTheme);
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        applyTheme('dark');
    }

    themeToggle && themeToggle.addEventListener('click', () => {
        const isDark = document.body.classList.contains('dark-mode');
        const newTheme = isDark ? 'light' : 'dark';
        localStorage.setItem('theme', newTheme);
        applyTheme(newTheme);
    });

    // Máscara para CNPJ
    const cnpjInputs = document.querySelectorAll('.cnpj-mask');
    cnpjInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/^(\d{2})(\d)/, '$1.$2');
            value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
            e.target.value = value;
        });
    });

    // Máscara para CPF
    const cpfInputs = document.querySelectorAll('.cpf-mask');
    cpfInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value;
        });
    });

    // Máscara para telefone
    const phoneInputs = document.querySelectorAll('.phone-mask');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 10) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            } else {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    });

    // Máscara para CEP
    const cepInputs = document.querySelectorAll('.cep-mask');
    cepInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        });
    });

    // Máscara para placa de veículo
    const placaInputs = document.querySelectorAll('.placa-mask');
    placaInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();
            if (value.length <= 7) {
                value = value.replace(/(\w{3})(\w)/, '$1-$2');
            }
            e.target.value = value;
        });
    });

    // Validação de CNPJ
    function validarCNPJ(cnpj) {
        cnpj = cnpj.replace(/[^\d]+/g, '');
        
        if (cnpj.length !== 14) return false;
        
        // Elimina CNPJs inválidos conhecidos
        if (/^(\d)\1+$/.test(cnpj)) return false;
        
        // Valida DVs
        let tamanho = cnpj.length - 2;
        let numeros = cnpj.substring(0, tamanho);
        let digitos = cnpj.substring(tamanho);
        let soma = 0;
        let pos = tamanho - 7;
        
        for (let i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
        }
        
        let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)) return false;
        
        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        
        for (let i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
        }
        
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)) return false;
        
        return true;
    }

    // Validação de CPF
    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        
        if (cpf.length !== 11) return false;
        
        // Elimina CPFs inválidos conhecidos
        if (/^(\d)\1+$/.test(cpf)) return false;
        
        // Valida 1º dígito
        let add = 0;
        for (let i = 0; i < 9; i++) {
            add += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let rev = 11 - (add % 11);
        if (rev == 10 || rev == 11) rev = 0;
        if (rev != parseInt(cpf.charAt(9))) return false;
        
        // Valida 2º dígito
        add = 0;
        for (let i = 0; i < 10; i++) {
            add += parseInt(cpf.charAt(i)) * (11 - i);
        }
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11) rev = 0;
        if (rev != parseInt(cpf.charAt(10))) return false;
        
        return true;
    }

    // Validação em tempo real
    cnpjInputs.forEach(input => {
        input.addEventListener('blur', function(e) {
            const cnpj = e.target.value;
            if (cnpj && !validarCNPJ(cnpj)) {
                e.target.classList.add('is-invalid');
                let feedback = e.target.parentNode.querySelector('.invalid-feedback');
                if (!feedback) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    e.target.parentNode.appendChild(feedback);
                }
                feedback.textContent = 'CNPJ inválido';
            } else {
                e.target.classList.remove('is-invalid');
                let feedback = e.target.parentNode.querySelector('.invalid-feedback');
                if (feedback) feedback.remove();
            }
        });
    });

    cpfInputs.forEach(input => {
        input.addEventListener('blur', function(e) {
            const cpf = e.target.value;
            if (cpf && !validarCPF(cpf)) {
                e.target.classList.add('is-invalid');
                let feedback = e.target.parentNode.querySelector('.invalid-feedback');
                if (!feedback) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    e.target.parentNode.appendChild(feedback);
                }
                feedback.textContent = 'CPF inválido';
            } else {
                e.target.classList.remove('is-invalid');
                let feedback = e.target.parentNode.querySelector('.invalid-feedback');
                if (feedback) feedback.remove();
            }
        });
    });

    // Confirmação de exclusão
    const deleteLinks = document.querySelectorAll('a[onclick*="confirm"]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Tem certeza que deseja excluir este item?')) {
                e.preventDefault();
            }
        });
    });

    // Auto-hide alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.classList.contains('show')) {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 150);
            }
        }, 5000);
    });
});

// Função para buscar CEP
function buscarCEP(cep, callback) {
    cep = cep.replace(/\D/g, '');
    
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    callback(data);
                }
            })
            .catch(error => console.error('Erro ao buscar CEP:', error));
    }
}

// Função para formatar moeda
function formatarMoeda(valor) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(valor);
}

// Função para validar email
function validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

