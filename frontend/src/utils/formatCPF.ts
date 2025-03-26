export const formatCPF = (cpf: string) => {
    let cleaned = cpf.replace(/\D/g, "");
    if (cleaned.length > 3) cleaned = cleaned.replace(/^(\d{3})(\d)/, "$1.$2");
    if (cleaned.length > 6) cleaned = cleaned.replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3");
    if (cleaned.length > 9) cleaned = cleaned.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, "$1.$2.$3-$4");
    return cleaned;
};
