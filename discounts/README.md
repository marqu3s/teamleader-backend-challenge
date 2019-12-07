# Discounts folder

Each discount must have its rules and logic defined in a class here.

Each class must apply only one discount and they must implement _IDiscount_ interface.

The active discounts can be configured in the attribute _$activeDiscounts_
of **models/Order**. They will be applied in ther order they were defined in the array.
