# Coupons Application - Admitad API Integration

A web-based coupon management system that integrates with the Admitad API to fetch and display promotional offers and campaigns.

## 🚀 Features

- **Campaign Management**: View and manage advertising campaigns
- **Coupon Display**: Browse and search through available coupons
- **API Integration**: Seamless integration with Admitad API
- **Database Storage**: SQLite database for local data management
- **Responsive Design**: Modern web interface for all devices

## 📁 Project Structure

```
coupons_final/
├── index.html              # Main application interface
├── campaign.php            # Campaign management functionality
├── campaign_summary.php    # Campaign summary display
├── get_campaigns.php       # API endpoint for campaigns
├── get_coupons.php         # API endpoint for coupons
├── coupons.db              # SQLite database
└── README.md               # This file
```

## 🛠️ Installation

### Prerequisites

- **XAMPP** (Apache + PHP + MySQL)
- **PHP 7.4+** with SQLite extension enabled
- **Web browser** (Chrome, Firefox, Safari, Edge)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/VinayBhopana/Coupons_Admitad_api.git
   cd Coupons_Admitad_api
   ```

2. **Place in web server directory**
   - Copy all files to your XAMPP `htdocs` folder
   - Or place in any web server directory

3. **Configure web server**
   - Ensure Apache is running
   - Make sure PHP is properly configured
   - Verify SQLite extension is enabled

4. **Access the application**
   - Open your web browser
   - Navigate to `http://localhost/coupons_final/`
   - Or your configured web server URL

## 🔧 Configuration

### Database Setup
The application uses SQLite database (`coupons.db`) which is included in the repository. No additional database setup is required.

### API Configuration
To integrate with Admitad API, you may need to:
1. Obtain API credentials from Admitad
2. Update API endpoints in the PHP files
3. Configure authentication headers

## 📖 Usage

### Main Interface
- Open `index.html` to access the main application
- Browse through available campaigns and coupons
- Use search functionality to find specific offers

### Campaign Management
- Access campaign details through `campaign.php`
- View campaign summaries via `campaign_summary.php`
- Manage campaign data through the web interface

### API Endpoints
- `get_campaigns.php`: Retrieves campaign data
- `get_coupons.php`: Fetches coupon information

## 🗄️ Database Schema

The application uses SQLite database with the following structure:
- **Campaigns table**: Stores campaign information
- **Coupons table**: Contains coupon details and offers
- **Relationships**: Links campaigns to their associated coupons

## 🔌 API Integration

### Admitad API
This application integrates with the Admitad affiliate network API to:
- Fetch real-time campaign data
- Retrieve current coupon offers
- Update promotional information automatically

### API Endpoints Used
- Campaign listing and details
- Coupon search and filtering
- Real-time offer updates

## 🎨 Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP 7.4+
- **Database**: SQLite
- **API**: Admitad Affiliate Network API
- **Server**: Apache (XAMPP)

## 📝 File Descriptions

| File | Description |
|------|-------------|
| `index.html` | Main application interface with modern UI |
| `campaign.php` | Campaign management and display logic |
| `campaign_summary.php` | Summary view for campaign statistics |
| `get_campaigns.php` | API handler for campaign data retrieval |
| `get_coupons.php` | API handler for coupon data retrieval |
| `coupons.db` | SQLite database containing application data |

## 🚀 Getting Started

1. **Quick Start**
   ```bash
   # Clone the repository
   git clone https://github.com/VinayBhopana/Coupons_Admitad_api.git
   
   # Navigate to project directory
   cd Coupons_Admitad_api
   
   # Start your web server (XAMPP)
   # Access via browser: http://localhost/Coupons_Admitad_api/
   ```

2. **Development Setup**
   - Ensure all prerequisites are installed
   - Configure your web server
   - Set up API credentials if needed
   - Test the application functionality

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Vinay Bhopana**
- GitHub: [@VinayBhopana](https://github.com/VinayBhopana)

## 🙏 Acknowledgments

- Admitad for providing the affiliate network API
- XAMPP community for the development environment
- Open source contributors and libraries

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Contact the author via GitHub profile
- Check the documentation for common issues

---

**Note**: This application requires proper API credentials and web server configuration to function fully. Make sure to follow the installation instructions carefully. 