class Procducts:
    def __init__(self,product):
        self.product = product
        self.bill = []
    def menu(self):
        for product in self.product:              
            print(f'{product}:{self.product[product]} VND')
    def buy(self):       
        quit = True
        while quit:
            choice = input('nhập đồ cần mua hoặc thoát bằng cách nhấp 1: ')
            check = 0
            for product in self.product:
                if choice == product:
                    so_luong = int(input('số lượng: '))
                    giá = (procducts[product]) * so_luong
                    self.bill.append(product)
                    self.bill.append(so_luong)
                    self.bill.append(giá)
                    check = 1
            if choice == '1':
                quit = False
                print('Xin cam on: ')
                check = 1   
            if check == 0:
                print('vui lòng nhập lại: ')
    def pay_bill(self):
        total = 0
        for i in range(0,len(self.bill),3):
            print(f'{self.bill[i]} * {self.bill[i+1]} = {self.bill[i+2]} VND')
            total += self.bill[i+2]
        print(f'Total: {total} VND')                         
procducts = {'water' : 4000, 'coca' : 10000, 'cake' : 15000, 'beer' : 13000}
customer = Procducts(procducts)
print("----Menu----")
customer.menu()
print("")
customer.buy()
print("")
customer.pay_bill()
