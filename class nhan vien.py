class NhanVien:
    def __init__(self):
        self.id = int(input('Nhập id nhân viên: '))
        self.name = input('Nhập tên nhân viên: ')
        self.age = int(input('Nhập tuổi của nhân viên: '))
        self.working_hours = float(input('Nhập số giờ làm của nhân viên: '))
        self.salary = 0
        self.bonus = 0
        self.total_salary = 0
    
    def print_info(self):
        print(f'Nhân viên thứ: {self.id}')
        print(f'Tên: {self.name}')
        print(f'Tuổi: {self.age}')
        print(f'Tổng số giờ làm việc: {self.working_hours}')

    def luong(self):
        self.salary = self.working_hours * 20000
        print(f'Tiền lương tháng này của bạn: {self.salary}')

    def thuong(self):
        if self.working_hours >= 200:
            self.bonus = self.salary * 0.25
            print(f'Tiền thưởng tháng này của bạn: {self.bonus}')
        elif self.working_hours >= 100 and self.working_hours < 200:
            self.bonus = self.salary * 0.1
            print(f'Tiền thưởng tháng này của bạn là: {self.bonus}')
        else:
            print(f'Tháng này bạn không có tiền thưởng. Hãy chăm chỉ hơn nhé!')

    def totall_salary(self):
        self.total_salary = self.salary + self.bonus 
        print(f'Tháng này bạn nhận được: {self.total_salary}')

nhanvien_1 = NhanVien()
nhanvien_1.print_info()
nhanvien_1.luong()
nhanvien_1.thuong()
nhanvien_1.totall_salary()