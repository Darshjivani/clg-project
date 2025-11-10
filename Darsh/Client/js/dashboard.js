// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const orderCards = document.querySelectorAll('.order-card');

    orderCards.forEach(card => {
        const orderId = card.querySelector('.order-id').textContent.toLowerCase();
        const origin = card.querySelector('.route-point:first-child .detail-value').textContent.toLowerCase();
        const destination = card.querySelector('.route-point:last-child .detail-value').textContent.toLowerCase();

        if (orderId.includes(searchTerm) || origin.includes(searchTerm) || destination.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// View order details
function viewOrderDetails(orderId) {
    const order = ordersData.find(o => o.ID == orderId);
    if (!order) return;

    const modalBody = document.getElementById('detailsModalBody');
    modalBody.innerHTML = `
        <div class="detail-grid">
            <div class="detail-box">
                <h4>Order ID</h4>
                <p>#${String(order.ID).padStart(6, '0')}</p>
            </div>
            <div class="detail-box">
                <h4>Shipment Type</h4>
                <p>${order.Shipment_Type.toUpperCase()}</p>
            </div>
            <div class="detail-box">
                <h4>Transport Mode</h4>
                <p>${order.Transport_Mode}</p>
            </div>
            <div class="detail-box">
                <h4>Shipment Charge</h4>
                <p>$${parseFloat(order.Shipment_Charge).toFixed(2)}</p>
            </div>
        </div>

        <h3 class="section-title">Contact Information</h3>
        <div class="detail-grid">
            <div class="detail-box">
                <h4>Full Name</h4>
                <p>${order.Full_Name}</p>
            </div>
            <div class="detail-box">
                <h4>Company Name</h4>
                <p>${order.Company_Name || 'N/A'}</p>
            </div>
            <div class="detail-box">
                <h4>Email</h4>
                <p>${order.Email}</p>
            </div>
            <div class="detail-box">
                <h4>Phone</h4>
                <p>${order.Phone}</p>
            </div>
        </div>

        <h3 class="section-title">Shipment Route</h3>
        <div class="detail-grid">
            <div class="detail-box">
                <h4>Origin Country</h4>
                <p>${order.Origin_Country}</p>
            </div>
            <div class="detail-box">
                <h4>Origin Port</h4>
                <p>${order.Origin_Port}</p>
            </div>
            <div class="detail-box">
                <h4>Destination Country</h4>
                <p>${order.Dest_Country}</p>
            </div>
            <div class="detail-box">
                <h4>Destination Port</h4>
                <p>${order.Dest_Port}</p>
            </div>
        </div>

        <h3 class="section-title">Product Information</h3>
        <div class="detail-grid">
            <div class="detail-box">
                <h4>Product Description</h4>
                <p>${order.Product_Description}</p>
            </div>
            <div class="detail-box">
                <h4>HS Code</h4>
                <p>${order.HS_Code || 'N/A'}</p>
            </div>
            <div class="detail-box">
                <h4>Weight</h4>
                <p>${parseFloat(order.Weight).toFixed(2)} kg</p>
            </div>
            <div class="detail-box">
                <h4>Quantity</h4>
                <p>${order.Quantity} units</p>
            </div>
            <div class="detail-box">
                <h4>Dimensions</h4>
                <p>${order.Dimensions || 'N/A'}</p>
            </div>
            <div class="detail-box">
                <h4>Shipment Time</h4>
                <p>${order.Shipment_Time || 'N/A'}</p>
            </div>
        </div>

        ${order.Instructions ? `
            <h3 class="section-title">Special Instructions</h3>
            <div class="detail-box">
                <p>${order.Instructions}</p>
            </div>
        ` : ''}
    `;

    openModal('detailsModal');
}

// Edit contact details
function editContact(orderId) {
    const order = ordersData.find(o => o.ID == orderId);
    if (!order) return;

    const modalBody = document.getElementById('editModalBody');
    modalBody.innerHTML = `
        <input type="hidden" name="order_id" value="${order.ID}">
        
        <h3 class="section-title">Contact Information</h3>
        <p style="color: #666; margin-bottom: 20px; font-size: 14px;">
            <i class="fas fa-info-circle"></i> You can only update contact details. Other order information cannot be modified.
        </p>
        
        <div class="form-grid">
            <div class="form-group">
                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" name="fullName" value="${order.Full_Name}" required>
            </div>
            <div class="form-group">
                <label for="companyName">Company Name</label>
                <input type="text" id="companyName" name="companyName" value="${order.Company_Name || ''}">
            </div>
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" value="${order.Email}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" value="${order.Phone}" required>
            </div>
        </div>

        <h3 class="section-title">Order Information (Read Only)</h3>
        <div class="form-grid">
            <div class="form-group">
                <label>Order ID</label>
                <input type="text" value="#${String(order.ID).padStart(6, '0')}" disabled>
            </div>
            <div class="form-group">
                <label>Shipment Type</label>
                <input type="text" value="${order.Shipment_Type.toUpperCase()}" disabled>
            </div>
            <div class="form-group">
                <label>Transport Mode</label>
                <input type="text" value="${order.Transport_Mode}" disabled>
            </div>
            <div class="form-group">
                <label>Product</label>
                <input type="text" value="${order.Product_Description}" disabled>
            </div>
        </div>
    `;

    openModal('editModal');
}

// Modal functions
function openModal(modalId) {
    document.getElementById(modalId).classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
window.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal')) {
        closeModal(e.target.id);
    }
});

// Auto-hide alerts
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.3s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    });
}, 5000);

