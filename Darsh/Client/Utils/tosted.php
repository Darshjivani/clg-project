<style>
    .success-message,
    .field-error {
        position: fixed;
        bottom: 1rem;
        right: 1.2rem;
        background: #27ae60;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.6rem;
        font-family: var(--primary-font);
        font-weight: 600;
        z-index: 1000;
        animation: slideIn 0.3s ease;
        transition: all .3s ease;
        overflow: hidden;
    }

    .success-message::before,
    .field-error::before {
        content: '';
        position: absolute;
        width: 100%;
        align-items: center;
        bottom: 0;
        height: 100%;
        left: 0;
        /* border-radius: 0.6rem; */
        border-bottom: .3rem solid #ffe3e6;
        animation: width 3s linear forwards
    }

    .success-message::before {
        border-bottom: .3rem solid #e3ffe6;
    }

    .field-error {
        background: #e74c3c;
    }

    @keyframes width {
        to {
            width: 0;
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(100%);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>
