class main {
    SELECTORS = {
        menu: '.shop-menu',
        list: '.shop-list',
        content: '.shop-content',
        menuItem: '.menu-item',
        listItem: '.list-item'
    };

    MENU_ITEM_CONTACTS = 0;
    MENU_ITEM_DEALS = 1;

    currentMenuItem = 0;
    currentListItem = null;

    menuItems = [];
    contacts = [];
    contracts = [];
    deals = [];
    headers = [];

    constructor() {
        this.menuItems = shopMainConfig.menuItems;
        this.contacts = shopMainConfig.contacts;
        this.contracts = shopMainConfig.contracts;
        this.deals = shopMainConfig.deals;
        this.headers = shopMainConfig.headers;
    }

    init() {
        this.drawBlocks();

        $(document).on('click', this.SELECTORS.menuItem, function (event) {
            let target = $(event.target);

            this.currentMenuItem = parseInt(target.attr('itemid'));
            this.currentListItem = null;
            this.drawBlocks();
        }.bind(this));

        $(document).on('click', this.SELECTORS.listItem, function (event) {
            let target = $(event.target);

            this.currentListItem = parseInt(target.attr('itemid'));
            this.drawBlocks();
        }.bind(this));
    }

    drawBlocks() {
        let menuBlock = $(this.SELECTORS.menu);
        menuBlock.html('');
        this.menuItems.forEach(function (name, index) {
            menuBlock.append(this.getMenuItem(name, index, index === this.currentMenuItem))
        }.bind(this));

        let listBlock = $(this.SELECTORS.list);
        listBlock.html('');
        if (this.currentMenuItem === this.MENU_ITEM_CONTACTS) {
            this.contacts.forEach(function (contact, index) {
                let name = contact.lastname + ' ' + contact.firstname;
                if (this.currentListItem === null) this.currentListItem = contact.id;
                listBlock.append(this.getListItem(name, contact.id, contact.id === this.currentListItem));
            }.bind(this));

            let currentContact = this.getCurrentContact();
            this.drawContactContentTable(currentContact, this.getContactContracts(currentContact));
        } else if (this.currentMenuItem === this.MENU_ITEM_DEALS) {
            this.contracts.forEach(function (contract, index) {
                if (this.currentListItem === null) this.currentListItem = contract.id;
                listBlock.append(this.getListItem(contract.name, contract.id, contract.id === this.currentListItem));
            }.bind(this));

            let currentContract = this.getCurrentContract();
            this.drawContractContentTable(currentContract, this.getContractContacts(currentContract));
        }
    }

    getMenuItem(name, id, active) {
        return $('<div></div>', {html: name, itemid: id, 'class': 'menu-item ' + (active ? 'active' : '')});
    }

    getListItem(name, id, active) {
        return $('<div></div>', {html: name, itemid: id, 'class': 'list-item ' + (active ? 'active' : '')});
    }

    drawContactContentTable(contact, contactContracts) {
        let table = $('<table></table>', {});

        let row;
        for (const key in contact) {
            row = $('<tr></tr>', {});
            let html = this.getTableHeaderFromKey(key);
            if (key === 'id') html = this.getTableHeaderFromKey('contactId');
            row.append($('<td></td>', {html: html}));
            row.append($('<td></td>', {html: contact[key]}));
            table.append(row);
        }

        contactContracts.forEach(function (contactContract) {
            let row;
            for (const key in contactContract) {
                row = $('<tr></tr>', {});
                let html = this.getTableHeaderFromKey(key);
                if (key === 'id') continue;
                else if (key === 'name') html = this.getTableHeaderFromKey('contractId') + ': ' + contactContract.id;
                row.append($('<td></td>', {html: html}));
                row.append($('<td></td>', {html: contactContract[key]}));
                table.append(row);
            }
        }.bind(this));

        let contentBlock = $(this.SELECTORS.content);
        contentBlock.html('');

        contentBlock.append(table);
    }

    drawContractContentTable(contract, contractContacts) {
        let table = $('<table></table>', {});

        let row;
        for (const key in contract) {
            row = $('<tr></tr>', {});
            let html = this.getTableHeaderFromKey(key);
            if (key === 'id') html = this.getTableHeaderFromKey('contractId');
            row.append($('<td></td>', {html: html}));
            row.append($('<td></td>', {html: contract[key]}));
            table.append(row);
        }

        contractContacts.forEach(function (contractContact) {
            let row;
            for (const key in contractContact) {
                row = $('<tr></tr>', {});
                let html = this.getTableHeaderFromKey(key);
                if (key === 'id') continue;
                else if (key === 'fullname') html = this.getTableHeaderFromKey('contactId') + ': ' + contractContact.id;
                row.append($('<td></td>', {html: html}));
                row.append($('<td></td>', {html: contractContact[key]}));
                table.append(row);
            }
        }.bind(this));

        let contentBlock = $(this.SELECTORS.content);
        contentBlock.html('');

        contentBlock.append(table);
    }

    getCurrentContact() {
        let currentContact;
        this.contacts.forEach(function (contact) {
            if (this.currentListItem === contact.id) currentContact = contact;
        }.bind(this));

        return currentContact;
    }

    getContactContracts(contact) {
        let contracts = [];
        this.deals.forEach(function (deal, index) {
            if (deal.contact === contact.id) {
                let contract = this.getContractById(deal.contract);
                contracts.push({id: contract.id, name: contract.name});
            }
        }.bind(this));

        return contracts;
    }

    getContractById(id) {
        let contract;

        this.contracts.forEach(function (_contract, index) {
            if (_contract.id === id) contract = _contract;
        }.bind(this));

        return contract;
    }

    getCurrentContract() {
        let currentContract;

        this.contracts.forEach(function (contract, index) {
            if (this.currentListItem === contract.id) currentContract = contract;
        }.bind(this));

        return currentContract;
    }

    getContractContacts(currentContract) {
        let contacts = [];

        this.deals.forEach(function (deal, index) {
            if (currentContract.id === deal.contract) {
                let contact = this.getContactById(deal.contact);
                contacts.push(contact)
            }
        }.bind(this));

        return contacts;
    }

    getContactById(id) {
        let contact = {};

        this.contacts.forEach(function (_contact, index) {
            if (_contact.id === id) {
                contact.id = _contact.id;
                contact.fullname = _contact.lastname + ' ' + _contact.firstname;
            }
        }.bind(this));

        return contact;
    }

    getTableHeaderFromKey(key) {
        if (this.headers[key] !== undefined) return this.headers[key];
        return key;
    }
}

(new main()).init();